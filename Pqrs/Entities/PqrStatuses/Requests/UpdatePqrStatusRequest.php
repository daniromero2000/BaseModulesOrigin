<?php

namespace Modules\Pqrs\Entities\PqrStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdatePqrStatusRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }
}
