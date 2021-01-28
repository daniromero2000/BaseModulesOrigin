<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCallCenterQuestionnaireQuestionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'   => ['required', 'max:255', 'bail'],
        ];
    }
}
