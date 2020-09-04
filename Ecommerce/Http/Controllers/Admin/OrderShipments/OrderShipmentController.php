<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderShipments;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\OrderShippingRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use Modules\Ecommerce\Entities\OrderShippings\Requests\CreateOrderShippingRequest;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\OrderShippingItemRepository;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Requests\CreateOrderShippingItemRequest;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;


class OrderShipmentController extends Controller
{
    private $orderRepo, $orderShippingInterf, $orderShippingItemInterf, $orderShippingRepo, $customerRepo, $orderStatusRepo;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderShippingInterface $orderShippingInterface,
        OrderShippingItemInterface $orderShippingItemInterface,
        OrderShippingRepository $orderShippingRepoInterfe,
        CustomerRepositoryInterface $customerRepository,
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->orderRepo                = $orderRepository;
        $this->orderShippingInterf      = $orderShippingInterface;
        $this->orderShippingItemInterf  = $orderShippingItemInterface;
        $this->orderShippingRepo        = $orderShippingRepoInterfe;
        $this->customerRepo             = $customerRepository;
        $this->orderStatusRepo          = $orderStatusRepository;
        $this->middleware(['permission:orders, guard:employee']);
    }

    public function index()
    {
        $employee_id =    auth()->guard('employee')->user()->id;
        $list = $this->orderShippingInterf->listOrderShippings();
        return view('ecommerce::admin.order-shipments.list', [
            'shipments' => $list,
            'employee_id' => $employee_id
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.order-shipments.create');
    }

    public function store(CreateOrderShippingRequest $request)
    {
        $request['employee_id']   = auth()->guard('employee')->user()->id;
        $request['company_id']    = auth()->guard('employee')->user()->subsidiary->company_id;
        $request['subsidiary_id'] = auth()->guard('employee')->user()->subsidiary->id;
        $shipment                 = $this->orderShippingInterf->createOrderShipping($request->input());
        $orderId                  = $request->order_id;
        $order                    = $this->orderRepo->findOrderById($orderId);
        $orderRepo                = new OrderRepository($order);
        $products                 = $orderRepo->listOrderedProducts();

        foreach ($products as $item) {
            $cant   =   $item->quantity;
            for ($i = 1; $i <= $cant;) {
                $shipmentItems = array(
                    'name'           =>  $item->name,
                    //'description'    =>  $item->description,
                    'sku'            =>  $item->sku,
                    'qty'            =>  1,
                    'weight'         =>  $item->weight,
                    'price'          =>  $item->price,
                    'base_price'     =>  $item->base_price,
                    'total'          =>  '0.00',
                    'base_total'     =>  '0.00',
                    'shipment_id'    =>   $shipment->id
                );
                $this->orderShippingItemInterf->createOrderShippingItem($shipmentItems);
                $i++;
            }
        }

        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.order-shipments.index');
    }

    public function show($id)
    {
        $orderShipment      = $this->orderShippingRepo->findOrderShipment($id);

        return view('ecommerce::admin.order-shipments.show', [
            'order'                 =>  $orderShipment->order,
            'items'                 =>  $orderShipment->shipmentItems,
            'customer'              =>  $this->customerRepo->findCustomerById($orderShipment->order->customer_id),
            'currentStatus'         =>  $this->orderStatusRepo->findOrderStatusById($orderShipment->order->order_status_id),
            'courier'               =>  $orderShipment->courier->name,
            'user'                  =>  auth()->guard('employee')->user(),
            'orderShipment'         =>  $orderShipment,
        ]);
    }

    public function edit($id)
    {
        return view('ecommerce::admin.order-shipments.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
