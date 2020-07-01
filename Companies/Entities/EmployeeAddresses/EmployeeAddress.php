<?php

namespace Modules\Companies\Entities\EmployeeAddresses;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Stratums\Stratum;

class EmployeeAddress extends Model
{
    use SoftDeletes;
    protected $table = 'employee_addresses';

    public $fillable = [
        'employee_id',
        'housing_id',
        'time_living',
        'stratum_id',
        'address',
        'city_id',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'Employee_id',
        'status',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }

    public function stratum()
    {
        return $this->belongsTo(Stratum::class);
    }
}
