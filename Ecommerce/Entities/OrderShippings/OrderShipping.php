<?php

namespace Modules\Ecommerce\Entities\OrderShippings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Collection;

class OrderShipping extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'shipments';

    protected $searchable = [
        'columns' => [
            'shipments.order_id' => 10,
            'shipments.track_number' => 10,
            'shipments.total_weight' => 5,
            'couriers.id' => 10,
            'couriers.name' => 10,
        ],
        /* 'columns' => [
            'customers.name' => 10,
            'orders.reference' => 8,
            'orders.id' => 8,
        ],
        'joins' => [
            'customers' => ['customers.id', 'orders.customer_id'],
            'order_product' => ['orders.id', 'order_product.order_id']
        ], */
        'joins' => [
            'couriers' => ['couriers.id', 'shipments.courier_id']
        ],
        'groupBy' => ['shipments.order_id']
    ];

    protected $fillable = [
        'order_id',
        'courier_id',
        'employee_id',
        'company_id',
        'subsidiary_id',
        'description',
        'total_qty',
        'total_weight',
        'track_number',
        'email_sent'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function courier()
    {
        return $this->belongsTo(Courier::class)->select('id','name');
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->select('id','reference','courier_id','customer_id','address_id');
    }

    public function shipmentItems()
    {
        return $this->hasMany(OrderShippingItem::class, 'shipment_id');
    }

    public function searchForShipment(string $order_id)
    {
        return self::search($order_id);
    }

    public function searchShipmentItems(string $shipment_id)
    {
        return self::search($shipment_id);
    }

    public function searchShipping(string $term): Collection
    {
        return self::search($term)->get();
    }


}
