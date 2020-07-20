<?php

namespace Modules\Companies\Entities\EmployeeStatusesLogs;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatusesLog extends Model
{
    protected $table = 'employee_statuses_logs';

    protected $fillable = [
        'employee_id',
        'status',
        'user_id',
    ];

    protected $hidden = [
        'id',
        'employee_id',
        'updated_at',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']);
    }

    public function user()
    {
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']);
    }
}
