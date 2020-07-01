<?php

namespace Modules\Pqrs\Entities\Pqrs\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePqrRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name'  => ['required'],
            'email' => ['required', 'email'],
        ];
    }
}
