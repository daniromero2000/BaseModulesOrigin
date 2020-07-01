<?php

namespace Modules\Companies\Entities\Employees;

use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\Epss\Eps;
use Modules\Generals\Entities\Genres\Genre;
use Modules\Development\Entities\Projects\Project;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\EmployeeAddresses\EmployeeAddress;
use Modules\Companies\Entities\EmployeeCommentaries\EmployeeCommentary;
use Modules\Companies\Entities\EmployeeEmails\EmployeeEmail;
use Modules\Companies\Entities\EmployeeEpss\EmployeeEps;
use Modules\Companies\Entities\EmployeeIdentities\EmployeeIdentity;
use Modules\Companies\Entities\EmployeePhones\EmployeePhone;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\EmployeeProfessions\EmployeeProfession;
use Modules\Companies\Entities\EmployeeStatusesLogs\EmployeeStatusesLog;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;
use Nicolaslopezj\Searchable\SearchableTrait;

class Employee extends Authenticatable
{
    use Notifiable, SoftDeletes, LaratrustUserTrait,  SearchableTrait;
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'status',
        'company_id',
        'employee_position_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'deleted_at',
        'status',
        'updated_at',
        'relevance',
        'employee_position_id',
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
        'updated_at',
    ];

    protected $searchable = [
        'columns' => [
            'employees.name'                      => 10,
            'employees.email'                     => 5,
            'employees.last_name'                 => 5,
            'employee_identities.identity_number' => 10,
            'employee_phones.phone'               => 10,
            'employee_emails.email'               => 5,
        ],
        'joins' => [
            'employee_identities' => ['employees.id', 'employee_identities.employee_id'],
            'employee_phones'     => ['employees.id', 'employee_phones.employee_id'],
            'employee_emails'     => ['employees.id', 'employee_emails.employee_id'],
        ],
    ];

    public function searchEmployee($term)
    {
        return self::search($term);
    }

    public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function department()
    {
        return $this->belongsToMany(Department::class); //department_employee
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function customerStatusesLogs()
    {
        return $this->hasMany(CustomerStatusesLog::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function employeeCommentaries()
    {
        return $this->hasMany(EmployeeCommentary::class);
    }

    public function employeeStatusesLogs()
    {
        return $this->hasMany(EmployeeStatusesLog::class);
    }

    public function employeeEmails()
    {
        return $this->hasMany(EmployeeEmail::class);
    }

    public function employeePhones()
    {
        return $this->hasMany(EmployeePhone::class);
    }

    public function employeeIdentities()
    {
        return $this->hasMany(EmployeeIdentity::class);
    }

    public function employeeAddresses()
    {
        return $this->hasMany(EmployeeAddress::class);
    }

    public function employeeEpss()
    {
        return $this->hasMany(EmployeeEps::class);
    }

    public function employeeProfessions()
    {
        return $this->hasMany(EmployeeProfession::class);
    }
}
