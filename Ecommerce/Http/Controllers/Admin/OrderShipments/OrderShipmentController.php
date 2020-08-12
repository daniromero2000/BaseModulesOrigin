<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderShipments;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;

use Modules\Ecommerce\Entities\OrderShippings\Repositories\OrderShippingRepository;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use Modules\Ecommerce\Entities\OrderShippings\Requests\CreateOrderShippingRequest;

use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\OrderShippingItemRepository;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Requests\CreateOrderShippingItemRequest;


class OrderShipmentController extends Controller
{
    private $orderRepo, $orderShippingInterf, $orderShippingItemInterf ;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderShippingInterface $orderShippingInterface,
        OrderShippingItemInterface $orderShippingItemInterface
        )
    {
        $this->orderRepo                = $orderRepository;
        $this->orderShippingInterf      = $orderShippingInterface;
        $this->orderShippingItemInterf  = $orderShippingItemInterface;
        $this->middleware(['permission:orders, guard:employee']);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $list = $this->orderShippingInterf->listOrderShippings();
        //dd($list[0]->courier);
        return view('ecommerce::admin.order-shipments.list', [
            'shipments' => $list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ecommerce::admin.order-shipments.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateOrderShippingRequest $request)
    {
        $shipment   =   $this->orderShippingInterf->createOrderShipping($request->all());
        //dd($shipment->id);
        $orderId    =   $request->order_id;
        $order      =   $this->orderRepo->findOrderById($orderId);
        $orderRepo  =   new OrderRepository($order);
        $products   =   $orderRepo->listOrderedProducts();
        //dd($products);
        foreach($products as $item){
            //dd($item);
            $cant   =   $item->quantity;
            for ($i = 1; $i <= $cant; ) {
                $shipmentItems = array(
                    'name'           =>  $item->name,
                    'description'    =>  $item->description,
                    'sku'            =>  $item->sku,
                    'qty'            =>  1,
                    'weight'         =>  $item->weight,
                    'price'          =>  $item->price,
                    'base_price'     =>  $item->base_price,
                    'total'          =>  '0.00',
                    'base_total'     =>  '0.00',
                    'shipment_id'    =>   $shipment->id
                );
                //dd($i) ;
                $this->orderShippingItemInterf->createOrderShippingItem($shipmentItems);
                $i++;
            }
            /* $shipmentItems = array(
                'name'           =>  $item->name,
                'description'    =>  $item->description,
                'sku'            =>  $item->sku,
                'qty'            =>  $item->quantity,
                'weight'         =>  $item->weight,
                'price'          =>  $item->price,
                'base_price'     =>  $item->base_price,
                'total'          =>  '0.00',
                'base_total'     =>  '0.00',
                'shipment_id'    =>   $shipment->id
            )
            $this->orderShippingItemInterf->createOrderShippingItem($shipmentItems); */
        }


        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.order-shipments.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('ecommerce::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ecommerce::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
