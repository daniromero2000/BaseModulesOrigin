<?php

namespace Modules\Companies\Entities\Interviews;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\InterviewCommentaries\InterviewCommentary;
use Modules\Companies\Entities\InterViewStatuses\InterviewStatus;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;

class Interview extends Model
{
    use SoftDeletes;
    protected $table = 'interviews';

    protected $fillable = [
        'name',
        'last_name',
        'identification_number',
        'birthday',
        'phone',
        'email',
        'address',
        'calification',
        'employee_position_id',
        'english_knowledge',
        'interview_status_id',
        'picture'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'interviews.name' => 10,
            'interviews.email' => 5,
            'interviews.last_name' => 5,
            'interviews.identification_number' => 5,
        ],
    ];

    public function searchInterview($term)
    {
        return self::search($term);
    }

    public function interviewStatus()
    {
        return $this->belongsTo(InterviewStatus::class);
    }

    public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function interviewCommentaries()
    {
        return $this->hasMany(InterviewCommentary::class);
    }
}
