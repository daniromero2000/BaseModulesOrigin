<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Orders;

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
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    private $orderRepo, $courierRepo, $customerRepo, $orderStatusRepo, $orderShippingRepo;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        OrderShippingInterface $orderShippingRepoInterfe
    ) {
        $this->orderRepo       = $orderRepository;
        $this->courierRepo     = $courierRepository;
        $this->customerRepo    = $customerRepository;
        $this->orderStatusRepo = $orderStatusRepository;
        $this->orderShippingRepo = $orderShippingRepoInterfe;
        $this->middleware(['permission:orders, guard:employee']);
    }

    public function index()
    {
        if (request()->has('q')) {
            $list = $this->orderRepo->searchOrder(request()->input('q') ?? '');
        } else {
            $list = $this->orderRepo->listOrders('created_at', 'desc');
        }

        return view('ecommerce::admin.orders.list', [
            'orders' => $list
        ]);
    }

    public function show($orderId)
    {
        $order = $this->orderRepo->findOrderById($orderId);
        $orderRepo = new OrderRepository($order);
        $order->courier = $orderRepo->getCouriers()->first();
        $order->address = $orderRepo->getAddresses()->first();
        $items = $orderRepo->listOrderedProducts();
        $couriers = $this->courierRepo->listCouriers()->pluck('name', 'id');
        $orderShipment = $this->orderShippingRepo->findOrderShipment($orderId);
        //dd($orderShipment);
        $count = count($items);

        $cant = 0;
        $weight = 0.00;

        //dd($items);

        foreach ($items as $item) {
            //dd($item->quantity);
            $cant += $item->quantity;

            $weight += $item->weight * number_format($item->quantity, 2);
            //dd($weight);
        }
        //dd($weight);
        return view('ecommerce::admin.orders.show', [
            'order'         =>  $order,
            'items'         =>  $items,
            'customer'      =>  $this->customerRepo->findCustomerById($order->customer_id),
            'currentStatus' =>  $this->orderStatusRepo->findOrderStatusById($order->order_status_id),
            'payment'       =>  $order->payment,
            'user'          =>  auth()->guard('employee')->user(),
            'couriers'      =>  $couriers,
            'cant'          =>  $cant,
            'weight'        =>  $weight,
            'orderShipment'   =>  $orderShipment,
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
