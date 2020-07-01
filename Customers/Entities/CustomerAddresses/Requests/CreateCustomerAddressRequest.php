<?php

namespace Modules\Customers\Entities\CustomerAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerAddressRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            //     'customer_id'      => ['required', 'bail'],
            // 'housing_id'       => ['required', 'bail'],
            // 'stratum_id'       => ['required', 'bail'],
            // 'city_id'          => ['required', 'bail'],
            // 'customer_address' => ['required', 'max:255', 'bail'],
            // 'time_living'      => ['required', 'max:255']
        ];
    }
}
