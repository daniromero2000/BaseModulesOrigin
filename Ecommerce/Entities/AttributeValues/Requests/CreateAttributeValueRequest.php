<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateAttributeValueRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['required']
        ];
    }
}
