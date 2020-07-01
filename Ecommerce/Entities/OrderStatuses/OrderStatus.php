<?php

namespace Modules\Ecommerce\Entities\OrderStatuses;

use Modules\Ecommerce\Entities\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;
    protected $table = 'order_statuses';

    protected $fillable = [
        'name',
        'color',
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
