<?php

namespace Modules\Companies\Entities\DepartmentsEmployees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentEmployee extends Model
{
    use SoftDeletes;
    protected $table = 'department_employee';

    protected $fillable = [
        'department_id',
        'employee_id',
    ];

    protected $dates  = [];

    protected $guarded = [
        'id',
        'department_id',
        'employee_id',
    ];

    public $timestamps = false;
}
