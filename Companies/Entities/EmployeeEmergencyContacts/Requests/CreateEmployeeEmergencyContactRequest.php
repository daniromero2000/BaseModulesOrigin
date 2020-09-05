<?php

namespace Modules\Companies\Entities\EmployeeEmergencyContacts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeEmergencyContactRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'bail'],
            'phone' => ['required', 'bail'],
            'employee_id' => ['required', 'bail'],
        ];
    }
}
