<?php

namespace Modules\Companies\Entities\EmployeePositions;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Departments\Department;

class EmployeePosition extends Model
{
    use SoftDeletes;
    protected $table = 'employee_positions';

    protected $fillable = [
        'position',
        'department_id',
        'is_active'
    ];

    protected $hidden = [];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
