<?php

namespace Modules\CallCenter\Entities\Questionnaires;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CallCenter\Entities\QuestionnaireQuestions\CallCenterQuestionnaireQuestion;

class CallCenterQuestionnaire extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_questionnaires';

    protected $fillable = [
        'name',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'update_at',
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

    public function questions()
    {
        return $this->hasMany(CallCenterQuestionnaireQuestion::class, 'id_call_center_questionnaire');
    }
}
