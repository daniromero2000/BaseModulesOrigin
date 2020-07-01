<?php

namespace Modules\Customers\Entities\CustomerEmails\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEmailRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'customer_id' => ['required', 'bail'],
            'email'       => ['required', 'max:255', 'email', 'unique:customer_emails']
        ];
    }
}
