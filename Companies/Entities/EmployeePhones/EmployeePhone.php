<?php

namespace Modules\Companies\Entities\EmployeePhones;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeePhone extends Model
{
    use SoftDeletes;
    protected $table = 'employee_phones';

    public $fillable = [
        'phone_type',
        'phone',
        'employee_id',
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'employee_id',
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
        return $this->belongsTo(Employee::class)
            ->select(['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']);
    }
}
