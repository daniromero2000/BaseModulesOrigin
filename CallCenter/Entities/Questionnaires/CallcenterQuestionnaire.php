<?php

namespace Modules\CallCenter\Entities\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterQuestionnaire extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_questionnaires';

    protected $fillable = [
        'question',
        'status',
    ];

    protected $hidden = [
        'id',
        'status',
        'created_at',
        'update_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];   
    
}
