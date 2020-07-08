<?php

namespace Modules\Companies\Entities\Departments;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'phone',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
        'city_id',
        'city',
        'employees',
        'opening_hours',
        'relevance',
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

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class)
            ->select(['id', 'name', 'address', 'phone', 'opening_hours', 'city_id', 'company_id', 'is_active']);
    }

    public function employees()
    {
        return $this->belongsToMany(employee::class)
            ->select(['id', 'department_id', 'employee_id']);
    }
}
