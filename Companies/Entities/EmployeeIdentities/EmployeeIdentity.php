<?php

namespace Modules\Companies\Entities\EmployeeIdentities;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\IdentityTypes\IdentityType;

class EmployeeIdentity extends Model
{
    use SoftDeletes;
    protected $table = 'employee_identities';
    public $fillable = [
        'identity_type_id',
        'identity_number',
        'expedition_date',
        'city_id',
        'employee_id',
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

    public function identityType()
    {
        return $this->belongsTo(IdentityType::class);
    }
}
