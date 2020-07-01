<?php

namespace Modules\Customers\Entities\CustomerPhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerPhoneRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'customer_id' => ['required', 'bail'],
            'phone_type'  => ['required', 'bail'],
            'phone'       => ['required', 'max:30']
        ];
    }
}
