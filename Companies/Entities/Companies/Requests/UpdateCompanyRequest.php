<?php

namespace Modules\Companies\Entities\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'bail', 'max:255'],
            'identification' => ['bail', 'max:255'],
            'company_type' => ['bail', 'max:255'],
            'country_id' => ['required'],
        ];
    }
}
