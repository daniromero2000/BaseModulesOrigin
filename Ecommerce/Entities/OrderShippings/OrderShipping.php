<?php

namespace Modules\Ecommerce\Entities\OrderShippings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Nicolaslopezj\Searchable\SearchableTrait;

class OrderShipping extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'shipments';

    protected $searchable = [
        'columns' => [
            'shipments.order_id' => 10,
        ],
        'groupBy' => ['shipments.order_id']
    ];

    protected $fillable = [
        'order_id',
        'courier_id',
        'employee_id',
        'company_id',
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

    public function order()
    {
        return $this->belongsTo(Order::class)->with(['courier']);
    }

    public function shipmentItems()
    {
        return $this->hasMany(OrderShippingItem::class, 'shipment_id');
    }

    public function courier()
    {
       return $this->belongsTo(Courier::class);
    }

    public function searchForShipment(string $order_id)
    {
        return self::search($order_id);
    }

    public function searchShipmentItems(string $shipment_id)
    {
        return self::search($shipment_id);
    }


}
