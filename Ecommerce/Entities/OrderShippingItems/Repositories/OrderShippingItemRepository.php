<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems\Repositories;

use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces\OrderShippingItemInterface;
use Modules\Ecommerce\Entities\OrderShippingItems\Exceptions\CreateOrderShippingItemErrorException;
use Illuminate\Support\Collection;

class OrderShippingItemRepository implements OrderShippingItemInterface
{
    protected $model;
    private $columns = [
        'name',
        'description',
        'description',
        'sku',
        'qty',
        'weight',
        'price',
        'base_price',
        'total',
        'base_total',
        'shipment_id',
        'created_at'
    ];

    public function __construct(OrderShippingItem $OrderShippingItem)
    {
        $this->model = $OrderShippingItem;
    }

    public function createOrderShippingItem(array $data): OrderShippingItem
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateOrderShippingItemErrorException($e);
        }
    }

    public function listOrderShippingItems(): Collection
    {
        //return $this->model->with(['courier'])->get($this->columns);
        return $this->model->get($this->columns);
    }


}
