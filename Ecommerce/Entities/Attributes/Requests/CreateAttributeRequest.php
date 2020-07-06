<?php

namespace Modules\Ecommerce\Entities\Attributes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateAttributeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }
}
