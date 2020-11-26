<?php

namespace Modules\Companies\Entities\Departments;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Companies\Company;
use Modules\Companies\Entities\DepartmentsEmployees\DepartmentEmployee;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Generals\Entities\Countries\Country;
use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadServices\LeadService;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'phone',
        'company_id',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'is_active'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class)
            ->select(['id', 'name', 'description', 'country_id', 'logo', 'is_active', 'is_active']);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class)->select(['employees.id', 'name']);
    }

    public function listEmployees()
    {
        return $this->hasMany(DepartmentEmployee::class)
            ->select(['id', 'department_id', 'employee_id']);
    }

    public function leadProducts()
    {
        return $this->belongsToMany(LeadProduct::class);
    }

    public function leadServices()
    {
        return $this->belongsToMany(LeadService::class);
    }

    public function leadStatus()
    {
        return $this->belongsToMany(LeadStatus::class);
    }

    public function employeePositions()
    {
        return $this->hasMany(EmployeePosition::class);
    }
}
