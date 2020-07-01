<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class CustomerStatusesLog extends Model
{
    use SoftDeletes;
    protected $table = 'customer_statuses_logs';
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
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
