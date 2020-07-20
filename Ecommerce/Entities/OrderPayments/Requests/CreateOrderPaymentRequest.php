<?php

namespace Modules\Ecommerce\Entities\OrderPayments\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateBrandRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:brands']
        ];
    }
}
