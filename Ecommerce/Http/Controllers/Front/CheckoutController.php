<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


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

        $billingAddress = $customer->frontCustomerAddresses()->first();

        return view('ecommerce::front.checkout', [
            'customer' => $customer,
            'billingAddress' => $billingAddress,
            'addresses' => $customer->frontCustomerAddresses()->get(),
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
