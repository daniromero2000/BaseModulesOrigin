<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Ecommerce\Entities\Cart\Requests\CartCheckoutRequest;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Requests\PayPalCheckoutExecutionRequest;
use Modules\Ecommerce\Entities\Carts\Requests\StripeExecutionRequest;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\PaymentMethods\Stripe\Exceptions\StripeChargingErrorException;
use Modules\Ecommerce\Entities\PaymentMethods\Stripe\StripeRepository;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use Exception;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use PayPal\Exception\PayPalConnectionException;

class CheckoutController extends Controller
{
    use ProductTransformable;

    private $cartRepo, $courierRepo, $addressRepo, $customerRepo, $productRepo;
    private $orderRepo, $payPal, $shippingRepo, $checkoutinterface;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerAddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        CheckoutRepository $checkoutRepository
    ) {
        $this->cartRepo     = $cartRepository;
        $this->courierRepo  = $courierRepository;
        $this->addressRepo  = $addressRepository;
        $this->customerRepo = $customerRepository;
        $this->productRepo  = $productRepository;
        $this->orderRepo    = $orderRepository;
        $this->checkoutinterface = $checkoutRepository;
    }

    public function index(Request $request)
    {
        $products = $this->cartRepo->getCartItems();
        $customer = $request->user();
        $rates = null;
        $shipment_object_id = null;

        $data = [
            'customer_id' => $customer->id
        ];

        $this->checkoutinterface->createCheckout($data);

        if (env('ACTIVATE_SHIPPING') == 1) {
            $shipment = $this->createShippingProcess($customer, $products);
            if (!is_null($shipment)) {
                $shipment_object_id = $shipment->object_id;
                $rates = $shipment->rates;
            }
        }

        // Get payment gateways
        $paymentGateways = collect(explode(',', config('payees.name')))->transform(function ($name) {
            return config($name);
        })->all();

        $billingAddress = $customer->customerAddresses()->first();

        return view('ecommerce::front.checkout', [
            'customer' => $customer,
            'billingAddress' => $billingAddress,
            'addresses' => $customer->customerAddresses()->get(),
            'products' => $this->cartRepo->getCartItems(),
            'subtotal' => $this->cartRepo->getSubTotal(),
            'tax' => $this->cartRepo->getTax(),
            'total' => $this->cartRepo->getTotal(2),
            'payments' => $paymentGateways,
            'cartItems' => $this->cartRepo->getCartItemsTransformed(),
            'shipment_object_id' => $shipment_object_id,
            'rates' => $rates,
        ]);
    }

    public function store(CartCheckoutRequest $request)
    {
        $shippingFee = 0;

        switch ($request->input('payment')) {
            case 'paypal':
                return $this->payPal->process($shippingFee, $request);
                break;
            case 'stripe':

                $details = [
                    'description' => 'Stripe payment',
                    'metadata' => $this->cartRepo->getCartItems()->all()
                ];

                $customer = $this->customerRepo->findCustomerById(auth()->id());
                $customerRepo = new CustomerRepository($customer);
                $customerRepo->charge($this->cartRepo->getTotal(2, $shippingFee), $details);
                break;
            default:
        }
    }

    public function executePayPalPayment(PayPalCheckoutExecutionRequest $request)
    {
        try {
            $this->payPal->execute($request);
            $this->cartRepo->clearCart();

            return redirect()->route('checkout.success');
        } catch (PayPalConnectionException $e) {
            throw new PaypalRequestError($e->getData());
        } catch (Exception $e) {
            throw new PaypalRequestError($e->getMessage());
        }
    }

    public function charge(StripeExecutionRequest $request)
    {
        try {
            $customer = $this->customerRepo->findCustomerById(auth()->id());
            $stripeRepo = new StripeRepository($customer);

            $stripeRepo->execute(
                $request->all(),
                Cart::total(),
                Cart::tax()
            );
            return redirect()->route('checkout.success')
                ->with('message', 'Stripe payment successful!');
        } catch (StripeChargingErrorException $e) {
            Log::info($e->getMessage());
            return redirect()->route('checkout.index')
                ->with('error', 'There is a problem processing your request.');
        }
    }

    public function cancel(Request $request)
    {
        return view('ecommerce::front.checkout-cancel', ['data' => $request->all()]);
    }

    public function success()
    {
        return view('ecommerce::front.checkout-success');
    }

    private function createShippingProcess(Customer $customer, Collection $products)
    {
        $customerRepo = new CustomerRepository($customer);

        if ($customerRepo->findAddresses()->count() > 0 && $products->count() > 0) {

            $this->shippingRepo->setPickupAddress();
            $deliveryAddress = $customerRepo->findAddresses()->first();
            $this->shippingRepo->setDeliveryAddress($deliveryAddress);
            $this->shippingRepo->readyParcel($this->cartRepo->getCartItems());

            return $this->shippingRepo->readyShipment();
        }
    }
}
