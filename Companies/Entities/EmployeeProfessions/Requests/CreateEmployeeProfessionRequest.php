<?php

namespace Modules\Companies\Entities\EmployeeProfessions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeProfessionRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'professions_list_id' => ['required'],
            'employee_id'         => ['required']
        ];
    }
}
