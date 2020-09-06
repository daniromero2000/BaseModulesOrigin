<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Nicolaslopezj\Searchable\SearchableTrait;

class OrderShippingItem extends Model
{
    use SearchableTrait;
    protected $table = 'shipment_items';

    protected $searchable = [
        'columns' => [
            'shipment_items.shipment_id' => 10,
        ],
        'groupBy' => ['shipment_items.shipment_id']
    ];

    protected $fillable = [
        'name',
        'description',
        'sku',
        'qty',
        'weight',
        'price',
        'base_price',
        'total',
        'base_total',
        'shipment_id',
    ];

    protected $hidden = [
        'updated_at',
        'id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];

    public function orderShiping()
    {
        return $this->belongsTo(OrderShipping::class)->select('id','order_id','courier_id','total_qty','total_weight','track_number');
    }

    public function searchForShipmentItems(string $shipment_id)
    {
        return self::search($shipment_id)->select('id','name','sku','qty','weight','price');
    }




}
