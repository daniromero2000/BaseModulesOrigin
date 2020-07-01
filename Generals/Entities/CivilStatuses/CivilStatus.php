<?php

namespace Modules\Generals\Entities\CivilStatuses;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class CivilStatus extends Model
{
    use SoftDeletes;
    protected $table = 'civil_statuses';

    protected $fillable = [
        'civil_status'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customers()
    {
        $this->hasMany(Customer::class);
    }

    public function employees()
    {
        $this->hasMany(Employee::class);
    }
}
