<?php

namespace Modules\Companies\Entities\InterviewStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateInterviewStatusRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:interview_statuses']
        ];
    }
}
