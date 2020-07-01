<?php

namespace Modules\Ecommerce\Entities\Couriers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCourierRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:couriers'],
            'cost' => ['required_if:is_free,0']
        ];
    }
}
