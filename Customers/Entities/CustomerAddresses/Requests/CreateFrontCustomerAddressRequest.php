<?php

namespace Modules\Customers\Entities\CustomerAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFrontCustomerAddressRequest extends BaseFormRequest
{

    public function rules()
    {
        return [

            // 'housing_id'       => ['required', 'bail'],
            // 'stratum_id'       => ['required', 'bail'],
            // 'city_id'          => ['required', 'bail'],
            'customer_address' => ['required', 'max:255', 'bail'],
            'phone'            => ['required', 'max:30', 'unique:customer_phones']
            // 'time_living'      => ['required', 'max:255']
        ];
    }
}
