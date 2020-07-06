<?php

namespace Modules\Companies\Entities\EmployeeAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeAddressRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'employee_id'      => ['required', 'bail'],
            'housing_id'       => ['required', 'bail'],
            'stratum_id'       => ['required', 'bail'],
            'city_id'          => ['required', 'bail'],
            'address' => ['required', 'max:255', 'bail'],
            'time_living'      => ['required', 'max:255']
        ];
    }
}
