<?php

namespace Modules\Ecommerce\Entities\OrderStatusesLogs;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Orders\Order;

class OrderStatusesLog extends Model
{
    use SoftDeletes;
    protected $table = 'order_statuses_logs';

    protected $fillable = [
        'customer_id',
        'status',
        'employee_id',
        'time_passed'
    ];

    protected $hidden = [
        'id',
        'customer_id',
        'updated_at',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Order::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
