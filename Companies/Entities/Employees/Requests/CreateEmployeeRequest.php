<?php

namespace Modules\Companies\Entities\Admins\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'                 => ['required', 'max:255', 'bail'],
            'last_name'            => ['required', 'max:255', 'bail'],
            'phone'                => ['max:255'],
            'is_active'            => ['max:3'],
            'employee_position_id' => ['required'],
        ];
    }
}
