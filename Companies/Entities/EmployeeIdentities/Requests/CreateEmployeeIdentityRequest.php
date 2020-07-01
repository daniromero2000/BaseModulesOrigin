<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeIdentityRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'identity_number'  => ['required', 'bail'],
            'expedition_date'  => ['required', 'bail', 'date'],
            'city_id'          => ['required', 'bail'],
            'employee_id'      => ['required', 'bail'],
            'identity_type_id' => ['required', 'bail'],
            'identity_number'  => ['required', 'max:20']
        ];
    }
}
