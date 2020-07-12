<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\Shipping\Repositories\Interfaces\ShippingRepositoryInterface;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Shippo_Shipment;
use Shippo_Transaction;

class BankTransferController extends Controller
{
    private $cartRepo, $shippingFee, $rateObjectId, $shipmentObjId;
    private $billingAddress, $carrier, $checkoutInterface;

    public function __construct(
        Request $request,
        CartRepositoryInterface $cartRepository,
        ShippingRepositoryInterface $shippingRepo,
        CheckoutRepository $checkoutRepository
    ) {
        $this->cartRepo = $cartRepository;
        $fee            = 0;
        $rateObjId      = null;
        $shipmentObjId  = null;
        $billingAddress = $request->input('billing_address');

        if ($request->has('rate')) {
            if ($request->input('rate') != '') {

                $rate_id = $request->input('rate');
                $rates = $shippingRepo->getRates($request->input('shipment_obj_id'));
                $rate = collect($rates->results)->filter(function ($rate) use ($rate_id) {
                    return $rate->object_id == $rate_id;
                })->first();

                $fee = $rate->amount;
                $rateObjId = $rate->object_id;
                $shipmentObjId = $request->input('shipment_obj_id');
                $this->carrier = $rate;
            }
        }

        $this->shippingFee       = $fee;
        $this->rateObjectId      = $rateObjId;
        $this->shipmentObjId     = $shipmentObjId;
        $this->billingAddress    = $billingAddress;
        $this->checkoutInterface = $checkoutRepository;
    }

    public function index()
    {
        return view('ecommerce::front.bank-transfer-redirect', [
            'subtotal'       => $this->cartRepo->getSubTotal(),
            'shipping'       => $this->shippingFee,
            'tax'            => $this->cartRepo->getTax(),
            'total'          => $this->cartRepo->getTotal(2, $this->shippingFee),
            'rateObjectId'   => $this->rateObjectId,
            'shipmentObjId'  => $this->shipmentObjId,
            'billingAddress' => $this->billingAddress
        ]);
    }

    public function store(Request $request)
    {
        $checkout = $this->checkoutInterface->getLastCheckout();
        $checkoutRepo = new CheckoutRepository($checkout);
        $orderStatusRepo = new OrderStatusRepository(new OrderStatus);
        $os = $orderStatusRepo->findByName('Ordenado');

        $order = $checkoutRepo->buildCheckoutItems([
            'reference'       => Uuid::uuid4()->toString(),
            'courier_id'      => 1, // @deprecated
            'customer_id'     => $request->user()->id,
            'address_id'      => $request->input('billing_address'),
            'order_status_id' => $os->id,
            'payment'         => strtolower(config('bank-transfer.name')),
            'discounts'       => 0,
            'sub_total'       => $this->cartRepo->getSubTotal(),
            'grand_total'     => $this->cartRepo->getTotal(2, $this->shippingFee),
            'total_shipping'  => $this->shippingFee,
            'total_paid'      => 0,
            'tax'             => $this->cartRepo->getTax()
        ]);

        if (env('ACTIVATE_SHIPPING') == 1) {
            $shipment = Shippo_Shipment::retrieve($this->shipmentObjId);

            $details = [
                'shipment' => [
                    'address_to' => json_decode($shipment->address_to, true),
                    'address_from' => json_decode($shipment->address_from, true),
                    'parcels' => [json_decode($shipment->parcels[0], true)]
                ],
                'carrier_account' => $this->carrier->carrier_account,
                'servicelevel_token' => $this->carrier->servicelevel->token
            ];

            $transaction = Shippo_Transaction::create($details);

            if ($transaction['status'] != 'SUCCESS') {
                Log::error($transaction['messages']);
                return redirect()->route('checkout.index')
                    ->with('error', 'There is an error in the shipment details. Check logs.');
            }

            $orderRepo = new OrderRepository($order);
            $orderRepo->updateOrder([
                'courier' => $this->carrier->provider,
                'label_url' => $transaction['label_url'],
                'tracking_number' => $transaction['tracking_number']
            ]);
        }

        Cart::destroy();
        $this->checkoutInterface->removeCheckout($checkout);

        return redirect()->route('accounts', ['tab' => 'orders'])
            ->with('message', 'Orden Exitosa!');
    }
}
