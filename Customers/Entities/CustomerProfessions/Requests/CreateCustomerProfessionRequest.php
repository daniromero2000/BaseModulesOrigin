<?php

namespace Modules\Customers\Entities\CustomerProfessions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerProfessionRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'professions_list_id' => ['required'],
            'customer_id'         => ['required']
        ];
    }
}
