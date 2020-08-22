<?php

namespace Modules\Companies\Entities\Companies\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatecompanyRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'bail', 'max:255'],
            'identification' => ['bail', 'max:255'],
            'company_type' => ['bail', 'max:255'],
            'country_id' => ['required'],
        ];
    }
}
