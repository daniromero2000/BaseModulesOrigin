<?php

namespace Modules\Leads\Entities\Leads\Requests;

use Modules\Leads\Entities\Tools\Base\BaseFormRequest;

class CreateLeadRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'identificationNumber' => 'unique:leads',
            'telephone' => 'unique:leads'
        ];
    }
}
