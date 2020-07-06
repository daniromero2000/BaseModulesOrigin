<?php

namespace Modules\Companies\Entities\Roles\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateRoleRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name'         => ['max:255', 'bail', 'unique:roles'],
            'display_name' => ['required', 'bail', 'max:255'],
            'description'  => ['max:255'],
            'roles'        => ['array']
        ];
    }
}
