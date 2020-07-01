<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class RegisterCustomerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'                 => 'required|string|max:255',
            'password'             => 'required|string|min:8|confirmed'
            // 'data_politics'        => ['required'],
        ];
    }
}
