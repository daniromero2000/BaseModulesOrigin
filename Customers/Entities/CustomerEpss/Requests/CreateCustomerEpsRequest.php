<?php

namespace Modules\Customers\Entities\CustomerEpss\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEpsRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'customer_id' => ['required', 'bail'],
            'eps_id'      => ['required']
        ];
    }
}
