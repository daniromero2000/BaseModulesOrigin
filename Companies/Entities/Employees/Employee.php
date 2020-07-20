<?php

namespace Modules\Companies\Entities\Employees;

use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\Epss\Eps;
use Modules\Generals\Entities\Genres\Genre;
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
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
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
        'is_active',
        'company_id',
        'subsidiary_id',
        'employee_position_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance',
        'is_active',
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
        return $this->belongsTo(EmployeePosition::class)
            ->select(['id', 'position', 'is_active']);
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
        return $this->hasMany(CustomerStatusesLog::class)
            ->select(['id', 'customer_id', 'status', 'employee_id', 'time_passed', 'created_at']);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class)
            ->select(['id', 'civil_status']);
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class)
            ->select(['id', 'eps', 'is_active']);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class)
            ->select(['id', 'genre']);
    }

    public function employeeCommentaries()
    {
        return $this->hasMany(EmployeeCommentary::class)
            ->select(['id', 'commentary', 'user', 'employee_id', 'created_at']);
    }

    public function employeeStatusesLogs()
    {
        return $this->hasMany(EmployeeStatusesLog::class)
            ->select(['id', 'employee_id', 'status', 'user_id', 'created_at']);
    }

    public function employeeEmails()
    {
        return $this->hasMany(EmployeeEmail::class)
            ->select(['id', 'email', 'employee_id', 'status', 'created_at']);
    }

    public function employeePhones()
    {
        return $this->hasMany(EmployeePhone::class)
            ->select(['id', 'phone_type', 'phone', 'employee_id', 'status', 'created_at']);
    }

    public function employeeIdentities()
    {
        return $this->hasMany(EmployeeIdentity::class)
            ->select(['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'employee_id', 'status', 'created_at']);
    }

    public function employeeAddresses()
    {
        return $this->hasMany(EmployeeAddress::class)
            ->select(['id', 'housing_id', 'address', 'time_living', 'stratum_id', 'city_id', 'employee_id', 'status', 'created_at']);
    }

    public function employeeEpss()
    {
        return $this->hasMany(EmployeeEps::class)
            ->select(['id', 'eps_id', 'employee_id', 'status', 'created_at']);
    }

    public function employeeProfessions()
    {
        return $this->hasMany(EmployeeProfession::class)
            ->select(['id', 'professions_list_id', 'employee_id', 'status', 'created_at']);
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class)
            ->select(['id', 'name', 'address', 'phone', 'city_id', 'company_id', 'is_active']);
    }
}
