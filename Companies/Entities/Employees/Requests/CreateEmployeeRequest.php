<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'email'                => ['required', 'max:255', 'email', Rule::unique('employees', 'email')->ignore($this->segment(3))]
        ];
    }
}
