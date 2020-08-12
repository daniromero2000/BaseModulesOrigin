<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;

class BalotoController extends Controller
{
    private $cartRepo, $checkoutInterface, $courierInterface;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CheckoutRepository $checkoutRepository,
        CourierRepositoryInterface $courierRepositoryInterface
    ) {
        $this->cartRepo          = $cartRepository;
        $this->courierInterface  = $courierRepositoryInterface;
        $this->checkoutInterface = $checkoutRepository;
    }

    public function store(Request $request)
    {
        $checkout          = $this->checkoutInterface->getLastCheckout();
        $courier           = $this->courierInterface->getCourier();
        $checkoutRepo      = new CheckoutRepository($checkout);

        $order = $checkoutRepo->buildCheckoutItems([
            'reference'       => Uuid::uuid4()->toString(),
            'courier_id'      => $courier->id, // @deprecated
            'customer_id'     => $request->user()->id,
            'address_id'      => $request->input('billing_address'),
            'order_status_id' => 5,
            'payment'         => strtolower(config('baloto.name')),
            'discounts'       => 0,
            'sub_total'       => $this->cartRepo->getSubTotal(),
            'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
            'total_shipping'  => $courier->cost,
            'total_paid'      => 0,
            'tax'             => $this->cartRepo->getTax()
        ]);

        Cart::destroy();
        $this->checkoutInterface->removeCheckout($checkout);

        return redirect()->route('thankupage_baloto', [
            'order' => $order,
            'total' => $order->grand_total
        ])->with('message', 'Orden Exitosa!');
    }
}
