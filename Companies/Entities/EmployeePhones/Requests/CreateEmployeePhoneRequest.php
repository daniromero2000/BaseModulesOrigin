<?php

namespace Modules\Companies\Entities\EmployeePhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeePhoneRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'employee_id' => ['required', 'bail'],
            'phone_type'  => ['required', 'bail'],
            'phone'       => ['required', 'max:30', 'unique:employee_phones']
        ];
    }
}
