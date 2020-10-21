<?php

namespace Modules\Companies\Entities\InterviewCommentaries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewCommentary extends Model
{
    use SoftDeletes;
    protected $table = 'interview_commentaries';

    protected $fillable = [
        'commentary',
        'user',
        'customer_notified',
        'interview_id'
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
