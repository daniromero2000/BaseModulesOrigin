<?php

namespace Modules\Companies\Entities\Subsidiaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Validator;

class CreateSubsidiaryRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name'          => ['required', 'bail', 'max:255'],
            'address'       => ['bail', 'max:255'],
            'phone'         => ['bail', 'max:255'],
            'opening_hours' => ['bail', 'max:255'],
            'city_id'       => ['required']
        ];
    }
}
