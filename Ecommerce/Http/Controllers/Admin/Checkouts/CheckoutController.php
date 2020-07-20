<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Checkouts;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Checkout\CheckoutRepository;

class CheckoutController extends Controller
{
    private $checkoutRepo, $customerRepo;

    public function __construct(
        CheckoutRepository $checkoutRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->checkoutRepo = $checkoutRepository;
        $this->customerRepo = $customerRepository;
        $this->middleware(['permission:orders, guard:employee']);
    }

    public function index()
    {
        return view('ecommerce::admin.checkouts.list', [
            'checkouts' => $this->checkoutRepo->listCheckouts('created_at', 'desc')
        ]);
    }

    public function show($checkoutId)
    {
        $checkout = $this->checkoutRepo->findCheckoutById($checkoutId);

        return view('ecommerce::admin.checkouts.show', [
            'checkout'         => $checkout,
            'items'         => $checkout->products,
            'customer'      => $checkout->customer,
        ]);
    }

    public function edit($orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);

        $orderRepo = new OrderRepository($order);
        $order->courier = $orderRepo->getCouriers()->first();
        $order->address = $orderRepo->getAddresses()->first();
        $items = $orderRepo->listOrderedProducts();

        return view('ecommerce::admin.orders.edit', [
            'statuses' => $this->orderStatusRepo->listOrderStatuses(),
            'order' => $order,
            'items' => $items,
            'customer' => $this->customerRepo->findCustomerById($order->customer_id),
            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),
            'payment' => $order->payment,
            'user' => auth()->guard('employee')->user()
        ]);
    }


    public function update(Request $request, $orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);
        $orderRepo = new OrderRepository($order);

        if ($request->has('total_paid') && $request->input('total_paid') != null) {
            $orderData = $request->except('_method', '_token');
        } else {
            $orderData = $request->except('_method', '_token', 'total_paid');
        }

        $orderRepo->updateOrder($orderData);

        return redirect()->route('admin.orders.edit', $orderId);
    }

    public function generateInvoice(int $id)
    {
        $order = $this->orderRepo->findOrderById($id);

        $data = [
            'order' => $order,
            'products' => $order->products,
            'customer' => $order->customer,
            'courier' => $order->courier,
            'address' => $order->address,
            'status' => $order->orderStatus,
            'payment' => $order->paymentMethod
        ];

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('ecommerce::invoices.orders', $data)->stream();
        return $pdf->stream();
    }

    private function transFormOrder(Collection $list)
    {
        $courierRepo = new CourierRepository(new Courier());
        $customerRepo = new CustomerRepository(new Customer());
        $orderStatusRepo = new OrderStatusRepository(new OrderStatus());

        return $list->transform(function (Order $order) use ($courierRepo, $customerRepo, $orderStatusRepo) {
            $order->courier = $courierRepo->findCourierById($order->courier_id);
            $order->customer = $customerRepo->findCustomerById($order->customer_id);
            $order->status = $orderStatusRepo->findOrderStatusById($order->order_status_id);
            return $order;
        })->all();
    }
}
