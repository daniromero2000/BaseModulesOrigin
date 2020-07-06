<?php

namespace Modules\Companies\Entities\Permissions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'         => ['required', 'bail', 'max:255'],
            'display_name' => ['required', 'max:255', 'bail'],
            'icon'         => ['required', 'max:255', 'bail'],
            'description'  => ['max:255'],
        ];
    }
}
