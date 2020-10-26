<?php

namespace Modules\Companies\Entities\InterViewStatuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewStatus extends Model
{
    use SoftDeletes;
    protected $table = 'interview_statuses';

    protected $fillable = [
        'name',
        'color'
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
}
