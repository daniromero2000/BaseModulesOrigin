<?php

namespace  Modules\Customers\Entities\CustomerCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerCommentaryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'customer_id' => ['required', 'bail'],
            'commentary'  => ['required', 'max:255', 'bail'],
        ];
    }
}
