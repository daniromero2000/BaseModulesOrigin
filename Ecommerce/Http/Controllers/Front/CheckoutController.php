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
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\PayUPayments;

class CheckoutController extends Controller
{
    use ProductTransformable;

    private $cartRepo, $courierRepo, $addressRepo, $customerRepo, $productRepo;
    private $orderRepo, $payPal, $shippingRepo, $checkoutinterface;
    private $countryRepo, $cityRepo, $provinceRepo;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerAddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        ProvinceRepositoryInterface $provinceRepository,
        CheckoutRepository $checkoutRepository
    ) {
        $this->cartRepo          = $cartRepository;
        $this->courierRepo       = $courierRepository;
        $this->addressRepo       = $addressRepository;
        $this->customerRepo      = $customerRepository;
        $this->productRepo       = $productRepository;
        $this->orderRepo         = $orderRepository;
        $this->provinceRepo      = $provinceRepository;
        $this->countryRepo       = $countryRepository;
        $this->cityRepo          = $cityRepository;
        $this->checkoutinterface = $checkoutRepository;
    }

    public function index(Request $request)
    {
        $customer           = $request->user();
        $rates              = null;
        $shipment_object_id = null;
        $products           = $this->cartRepo->getCartItems();
        if (env('ACTIVATE_SHIPPING') == 1) {
            $shipment = $this->createShippingProcess($customer, $products);
            if (!is_null($shipment)) {
                $shipment_object_id = $shipment->object_id;
                $rates = $shipment->rates;
            }
        }

        // Get payment gateways
        $array = PayUPayments::getPaymentMethods();
        $paymentGateways = collect(explode(',', config('payees.name')))->transform(function ($name) {
            return config($name);
        })->all();

        $data = ['customer_id' => $customer->id];
        $this->checkoutinterface->createCheckout($data);

        return view('ecommerce::front.checkout', [
            'customer'           => $customer,
            'countries'          => $this->countryRepo->listCountries(),
            'cities'             => $this->cityRepo->listCities(),
            'provinces'          => $this->provinceRepo->listProvinces(),
            'billingAddress'     => $customer->frontCustomerAddresses()->first(),
            'addresses'          => $customer->frontCustomerAddresses()->get(),
            'products'           => $this->cartRepo->getCartItems(),
            'subtotal'           => $this->cartRepo->getSubTotal(),
            'tax'                => $this->cartRepo->getTax(),
            'total'              => $this->cartRepo->getTotal(2),
            'payments'           => $paymentGateways,
            'cartItems'          => $this->cartRepo->getCartItemsTransformed(),
            'shipment_object_id' => $shipment_object_id,
            'rates'              => $rates,
            'payu_payment_methods' => $array->paymentMethods
        ]);
    }

    public function cancel(Request $request)
    {
        return view('ecommerce::front.checkout-cancel', [
            'data' => $request->all()
        ]);
    }

    public function getCountry($id)
    {
        if ($id > 0) {
            return $this->countryRepo->findCountryById($id)->provinces;
        }
    }

    public function getProvince($id)
    {
        if ($id > 0) {
            return $this->cityRepo->findCityByProvince($id);
        }
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
