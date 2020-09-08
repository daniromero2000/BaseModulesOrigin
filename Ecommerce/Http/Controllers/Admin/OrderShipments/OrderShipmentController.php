<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderShipments;

use Illuminate\Routing\Controller;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\OrderShippingRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use Modules\Ecommerce\Entities\OrderShippings\Requests\CreateOrderShippingRequest;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class OrderShipmentController extends Controller
{
    private $orderRepo, $orderShippingInterf, $orderShippingItemInterf, $orderShippingRepo, $customerRepo;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        OrderRepositoryInterface $orderRepository,
        OrderShippingInterface $orderShippingInterface,
        OrderShippingItemInterface $orderShippingItemInterface,
        OrderShippingRepository $orderShippingRepoInterfe,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->orderRepo                = $orderRepository;
        $this->orderShippingInterf      = $orderShippingInterface;
        $this->orderShippingItemInterf  = $orderShippingItemInterface;
        $this->orderShippingRepo        = $orderShippingRepoInterfe;
        $this->customerRepo             = $customerRepository;
        $this->middleware(['permission:orders, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
         
            $skip = 0;
            $list = $this->orderShippingRepo->searchShipping(request()->input('q'));
            //dd($list);
        }
        else {
            $skip = $this->toolsInterface->getSkip($request->input('skip')); //CREARMETODO getSkip
            $list = $this->orderShippingInterf->listOrderShippings($skip * 30);
        }

        //$list       = $this->orderShippingInterf->listOrderShippings($skip * 30);
        $company_id = auth()->guard('employee')->user()->subsidiary->company_id;

        return view('ecommerce::admin.order-shipments.list', [
            'shipments'     =>  $list,
            'employee_id'   =>  auth()->guard('employee')->user()->id,
            'company_id'    =>  $company_id,
            'optionsRoutes'  => 'admin.' . (request()->segment(2)),
            'skip'           => $skip
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
        $request['subsidiary_id'] = auth()->guard('employee')->user()->subsidiary->id; // este hay que borrarlo porque sobra
        $shipment                 = $this->orderShippingInterf->createOrderShipping($request->input());
        $orderId                  = $request->order_id;
        $order                    = $this->orderRepo->findOrderById($orderId);
        $orderRepo                = new OrderRepository($order);
        $products                 = $orderRepo->listOrderedProducts();
        // tratar de optimizzar con attach 
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
        $orderShipment      =   $this->orderShippingRepo->findOrderShipment($id);
        $customer           =   $this->customerRepo->findCustomerByIdforShipment($orderShipment->order->customer_id);
        $courier            =   $orderShipment->courier->name;
        $address            =   $orderShipment->order->address->customer_address;
        $city               =   $orderShipment->order->address->city->city;
        return view('ecommerce::admin.order-shipments.show', [
            'customer'              =>  $customer,
            'orderShipment'         =>  $orderShipment,
            'courier'               =>  $courier,
            'address'               =>  $address,
            'city'                  =>  $city,
        ]);
    }

    public function edit($id)
    {
        return view('ecommerce::admin.order-shipments.edit');
    }
}
