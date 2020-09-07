<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Repositories;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use Modules\Ecommerce\Entities\OrderShippings\Exceptions\CreateOrderShippingErrorException;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Exceptions\CreateOrderShippingItemErrorException;
use Illuminate\Support\Collection;

class OrderShippingRepository implements OrderShippingInterface
{
    protected $model;
    private $columns = [
        'id',
        'order_id',
        'courier_id',
        'company_id',
        'total_qty',
        'total_weight',
        'track_number',
    ];

    public function __construct(OrderShipping $orderShipping)
    {
        $this->model = $orderShipping;
    }

    public function createOrderShipping(array $data): OrderShipping
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateOrderShippingErrorException($e);
        }
    }

    public function listOrderShippings(int $totalView): Collection
    {
        return $this->model->with(['courier'])->skip($totalView)->take(30)->get($this->columns);

        
        //
        //->get($this->columns);
    }

    public function findOrderShipment(int $order_id): OrderShipping
    {
        try {
            return $this->model->with(['shipmentItems', 'order'])->findOrFail($order_id);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findShipmentItems(int $shipment_id): Collection
    {
        return $this->model->searchShipmentItems($shipment_id)->get();
    }


    public function searchShipping(string $text): Collection
    {
        
        if (!empty($text)) {
            return $this->model->searchShipping($text);
        } else {
            return $this->listOrderShippings(0);
        }
    }


}
