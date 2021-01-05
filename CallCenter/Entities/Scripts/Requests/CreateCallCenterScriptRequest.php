<?php

namespace Modules\CallCenter\Entities\Scripts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCallCenterScriptRequest extends FormRequest
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
