<?php

namespace Modules\Companies\Entities\Admins\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => ['required', 'email', 'bail', 'max:255'],
            'password' => ['required']
        ];
    }
}
