<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => ['required', 'email', 'bail', 'max:255'],
        ];
    }
}
