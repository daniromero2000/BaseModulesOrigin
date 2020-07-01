<?php

namespace Modules\Customers\Entities\CustomerVehicles\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerVehicleRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'vehicle_type_id'  => ['required'],
            'vehicle_brand_id' => ['required']
        ];
    }
}
