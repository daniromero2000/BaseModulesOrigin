<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Repositories;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\OrderShippings\Repositories\Interfaces\OrderShippingInterface;
use Illuminate\Support\Collection;

class OrderShippingRepository implements OrderShippingInterface
{
    protected $model;
    private $columns = [
        'order_id',
        'courier_id',
        'total_qty',
        'total_weight',
        'track_number',
        'email_sent',
        'created_at'
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

    public function listOrderShippings(): Collection
    {
        return $this->model->with(['courier'])->get($this->columns);
    }

    public function findOrderShipment(int $orderId): Collection
    {
        return $this->model->searchForShipment($orderId)->get();
    }



}
