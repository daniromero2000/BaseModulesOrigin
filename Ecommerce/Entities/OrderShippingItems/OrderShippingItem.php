<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderShippings\OrderShipping;
use Modules\Ecommerce\Entities\Couriers\Courier;

class OrderShippingItem extends Model
{
    use SoftDeletes;
    protected $table = 'shipment_items';

    protected $fillable = [
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

    public function orderShiping()
    {
        return $this->belongsTo(OrderShipping::class);
    }




}
