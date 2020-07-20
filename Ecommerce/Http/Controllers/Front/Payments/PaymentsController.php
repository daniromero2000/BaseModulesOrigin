<?php

namespace Modules\Ecommerce\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Client\PayuClient;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\Contracts\PayuClientInterface;
use Modules\Ecommerce\Entities\PaymentMethods\PayU\lib\PayU\util\PayUParameters;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Modules\Ecommerce\Events\OrderCreateEvent;

class PaymentsController extends Controller
{
    private $cartRepo, $shippingFee, $checkoutInterface;

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
        $paymentDataRequest =  $request->input();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $paymentDataRequest['ip'] = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $paymentDataRequest['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $paymentDataRequest['ip'] = $_SERVER['REMOTE_ADDR'];
        }
        $paymentDataRequest['PAYER_COOKIE']      = $request->session()->getId();
        $paymentDataRequest['USER_AGENT']        = $_SERVER['HTTP_USER_AGENT'];
        $paymentDataRequest['DEVICE_SESSION_ID'] = session_id() . microtime();

        $checkout        = $this->checkoutInterface->getLastCheckout();
        $courier         = $this->courierInterface->getCourier();
        $checkoutRepo    = new CheckoutRepository($checkout);
        $orderStatusRepo = new OrderStatusRepository(new OrderStatus);

        $order = $checkoutRepo->buildPayUCheckoutItems([
            'reference'       => Uuid::uuid4()->toString(),
            'courier_id'      => 1, // @deprecated
            'customer_id'     => $request->user()->id,
            'address_id'      => $request->input('billingAddress'),
            'order_status_id' => $orderStatusRepo->findByName('Pagado')->id,
            'payment'         => strtolower(config('payu.name') . '-' . $paymentDataRequest['PAYMENT_METHOD']),
            'discounts'       => 0,
            'sub_total'       => $this->cartRepo->getSubTotal(),
            'grand_total'     => $this->cartRepo->getTotal(2, $courier->cost),
            'total_shipping'  => $courier->cost,
            'total_paid'      => $this->cartRepo->getTotal(2, $courier->cost),
            'tax'             => $this->cartRepo->getTax()
        ]);

        $payuClient = new PayuClient(config('payu'));
        $this->pay($payuClient, $order, $paymentDataRequest, $checkout);

        if ($order->orderPayments[0]->state == 'APPROVED') {
            return redirect()->route('thankupage_payu', [
                'order'          => $order,
                'total'          => $order->grand_total,
                'transaction_id' => $order->orderPayments[0]->transaction_id
            ])->with('message', 'Orden Exitosa!');
        } else {
            return redirect()->route('checkout.index')
                ->with('error', 'Proceso Rechazado!' . ' ' . $order->orderPayments[0]->description);
        }
    }

    public function pay(PayuClientInterface $payuClient, $order, $paymentDataRequest, $checkout)
    {
        $data = [
            PayUParameters::REFERENCE_CODE => $order->reference,
            PayUParameters::DESCRIPTION => 'Payment cc test',
            PayUParameters::VALUE => $order->grand_total,
            PayUParameters::TAX_VALUE => $order->tax_amount,
            PayUParameters::TAX_RETURN_BASE => $order->sub_total,
            PayUParameters::CURRENCY => 'COP',
            // -- Comprador --
            PayUParameters::BUYER_ID => $order->customer->id,
            PayUParameters::BUYER_NAME => $order->customer->name . ' ' . $order->customer->last_name,
            PayUParameters::BUYER_EMAIL => $order->customer->email,
            PayUParameters::BUYER_CONTACT_PHONE => $order->customer->customerPhones[0]->phone,
            PayUParameters::BUYER_DNI => "",
            PayUParameters::BUYER_STREET => $order->address->customer_address,
            PayUParameters::BUYER_STREET_2 => $order->address->customer_address,
            PayUParameters::BUYER_CITY => $order->address->city->city,
            PayUParameters::BUYER_STATE => $order->address->city->province->province,
            PayUParameters::BUYER_COUNTRY => "CO",
            PayUParameters::BUYER_POSTAL_CODE => "000000",
            PayUParameters::BUYER_PHONE => $order->customer->customerPhones[0]->phone,
            // -- Pagador --
            PayUParameters::PAYER_ID => "1",
            PayUParameters::PAYER_NAME => $paymentDataRequest['BUYER_NAME'],
            PayUParameters::PAYER_EMAIL => $order->customer->email,
            PayUParameters::PAYER_CONTACT_PHONE => $order->customer->customerPhones[0]->phone,
            PayUParameters::PAYER_DNI => '',
            PayUParameters::PAYER_STREET => $order->address->customer_address,
            PayUParameters::PAYER_STREET_2 => $order->address->customer_address,
            PayUParameters::PAYER_CITY => $order->address->city->city,
            PayUParameters::PAYER_STATE => $order->address->city->province->province,
            PayUParameters::PAYER_COUNTRY => "CO",
            PayUParameters::PAYER_POSTAL_CODE => "000000",
            PayUParameters::PAYER_PHONE => $order->customer->customerPhones[0]->phone,

            PayUParameters::INSTALLMENTS_NUMBER => $paymentDataRequest['INSTALLMENTS_NUMBER'],
            // -- Datos de la tarjeta de crédito --
            PayUParameters::CREDIT_CARD_NUMBER => $paymentDataRequest['CREDIT_CARD_NUMBER'], // '4907840000000005',
            PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $paymentDataRequest['age'] . '/' . $paymentDataRequest['day'],
            PayUParameters::CREDIT_CARD_SECURITY_CODE => $paymentDataRequest['CREDIT_CARD_SECURITY_CODE'],
            PayUParameters::PAYMENT_METHOD => $paymentDataRequest['PAYMENT_METHOD'], // VISA, MASTERCARD, ...

            PayUParameters::COUNTRY => 'CO',
            PayUParameters::DEVICE_SESSION_ID => $paymentDataRequest['DEVICE_SESSION_ID'],
            PayUParameters::IP_ADDRESS => $paymentDataRequest['ip'],
            PayUParameters::PAYER_COOKIE,  $paymentDataRequest['PAYER_COOKIE'],
            PayUParameters::USER_AGENT => $paymentDataRequest['USER_AGENT'],
            //Solicitud de autorización y captura
            // TransactionResponse response = PayUPayments.doAuthorizationAndCapture(parameters)
        ];

        $payuClient->pay($data, function ($response) use ($order, $checkout) {
            $orderRepo = new OrderRepository($order);
            $orderPaymentRepo = new OrderPayment();
            $orderPaymentRepo['transaction_id'] = $response->transactionResponse->orderId;
            $orderPaymentRepo['method'] = $response->transactionResponse->extraParameters->BANK_REFERENCED_CODE;
            $orderPaymentRepo['description'] = $response->transactionResponse->responseCode . ' ' .  $response->transactionResponse->responseMessage;
            $orderPaorderPaymentRepoyment['transaction_order'] = $response->transactionResponse->transactionId;
            $orderPaymentRepo['state'] = $response->transactionResponse->state;
            $orderPaymentRepo['order_id'] = $order->id;
            $order->orderPayments()->save($orderPaymentRepo);

            if ($response->code == 'SUCCESS') {
                if ($response->transactionResponse->state == 'APPROVED') {
                    $orderRepo->buildOrderDetails(Cart::content());
                    event(new OrderCreateEvent($order));
                    Cart::destroy();
                    $this->checkoutInterface->removeCheckout($checkout);
                } else {
                    $orderRepo->removeOrder();
                }
            } else {
                dd($response);
            }
        }, function ($error) {
            dd($error);
        });
    }

    public function doPing(PayuClientInterface $payuClient)
    {
        $payuClient->doPing(function ($response) {
            $code = $response->code;
            dd($code);
        }, function ($error) {
            dd($error);
        });
    }
}
