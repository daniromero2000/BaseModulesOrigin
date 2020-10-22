<?php

namespace  Modules\Companies\Entities\InterviewCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateInterviewCommentaryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'interview_id' => ['required', 'bail'],
            'commentary'  => ['required', 'max:255', 'bail'],
        ];
    }
}
