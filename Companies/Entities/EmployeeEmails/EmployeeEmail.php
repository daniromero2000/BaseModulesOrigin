<?php

namespace Modules\Companies\Entities\EmployeeEmails;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeEmail extends Model
{
    use SoftDeletes;
    protected $table = 'employee_emails';

    public $fillable = [
        'employee_id',
        'email'
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
        return $this->belongsTo(Employee::class);
    }
}
