<?php

namespace Modules\Companies\Entities\EmployeeCommentaries;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCommentary extends Model
{
    use SoftDeletes;
    protected $table = 'employee_commentaries';

    public $fillable = [
        'employee_id',
        'commentary',
        'user',
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance',
        'id',
        'status',
        'employee_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'user'
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
