<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterQuestionnaireQuestion extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_questionnaire_questions';

    protected $fillable = [
        'id',
        'id_call_center_questionnaire',
        'question',
        'typeAnswer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];   
    
}
