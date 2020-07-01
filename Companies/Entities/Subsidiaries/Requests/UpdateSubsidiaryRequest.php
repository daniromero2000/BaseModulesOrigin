<?php

namespace Modules\Companies\Entities\Subsidiaries\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubsidiaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => ['required', 'bail', 'max:255'],
            'address'       => ['bail', 'max:255'],
            'phone'         => ['bail', 'max:255'],
            'opening_hours' => ['bail', 'max:255'],
            'city_id'       => ['required']
        ];
    }
}
