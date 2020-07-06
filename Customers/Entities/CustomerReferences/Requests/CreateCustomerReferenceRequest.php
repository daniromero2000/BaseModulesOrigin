<?php

namespace Modules\Customers\Entities\CustomerReferences\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerReferenceRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'customer_id'     => ['required'],
            'relationship_id' => ['required']
        ];
    }
}
