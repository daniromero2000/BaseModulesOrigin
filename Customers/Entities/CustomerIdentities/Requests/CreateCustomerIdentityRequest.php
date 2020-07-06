<?php

namespace Modules\Customers\Entities\CustomerIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerIdentityRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'identity_number'  => ['required', 'bail'],
            'expedition_date'  => ['required', 'bail', 'date'],
            'city_id'          => ['required', 'bail'],
            'customer_id'      => ['required', 'bail'],
            'identity_type_id' => ['required', 'bail'],
            'identity_number'  => ['required', 'max:20']
        ];
    }
}
