<?php

namespace Modules\Companies\Entities\InterviewStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateInterviewStatusRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('intereview_statuses')->ignore($this->segment('4'))]
        ];
    }
}
