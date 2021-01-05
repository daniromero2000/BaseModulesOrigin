<?php

namespace Modules\CallCenter\Entities\ManagementIndicators\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCallCenterManagementIndicatorsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'    => ['required', 'max:255', 'bail']
        ];
    }
}
