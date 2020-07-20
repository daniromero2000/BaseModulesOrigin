<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Ramsey\Uuid\Uuid;

class BankTransferController extends Controller
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

    public function index()
    {
    }

    public function store(Request $request)
    {
        $checkout          = $this->checkoutInterface->getLastCheckout();
        $courier           = $this->courierInterface->getCourier();
        $checkoutRepo      = new CheckoutRepository($checkout);
        $orderStatusRepo   = new OrderStatusRepository(new OrderStatus);

        $order = $checkoutRepo->buildCheckoutItems([
            'reference'       => Uuid::uuid4()->toString(),
            'courier_id'      => $courier->id, // @deprecated
            'customer_id'     => $request->user()->id,
            'address_id'      => $request->input('billing_address'),
            'order_status_id' => $orderStatusRepo->findByName('Ordenado')->id,
            'payment'         => strtolower(config('bank-transfer.name')),
            'discounts'       => 0,
            'sub_total'       => $this->cartRepo->getSubTotal(),
            'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
            'total_shipping'  => $courier->cost,
            'total_paid'      => 0,
            'tax'             => $this->cartRepo->getTax()
        ]);

        Cart::destroy();
        $this->checkoutInterface->removeCheckout($checkout);

        return redirect()->route('thankupage_bancolombia', [
            'order' => $order,
            'total' => $order->grand_total
        ])->with('message', 'Orden Exitosa!');
    }
}
