<?php

namespace Modules\Ecommerce\Entities\OrderCommentaries;

use Modules\Ecommerce\Entities\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderCommentary extends Model
{
    use SoftDeletes;
    protected $table = 'order_commentaries';

    public $fillable = [
        'customer_id',
        'commentary',
        'user'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance',
        'id',
        'status',
        'customer_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'user'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class)
            ->select(['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'sub_total', 'tax_amount', 'grand_total', 'created_at']);
    }
}
