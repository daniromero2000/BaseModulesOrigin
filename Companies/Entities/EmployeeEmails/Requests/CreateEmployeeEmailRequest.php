<?php

namespace Modules\Companies\Entities\EmployeeEmails\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class CreateEmployeeEmailRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'employee_id' => ['required', 'bail'],
            'email'       => ['required', 'max:255', 'email', 'unique:employee_emails']
        ];
    }
}
