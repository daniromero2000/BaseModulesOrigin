<?php

namespace Modules\Ecommerce\Entities\Products\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => ['required'],
            'name' => ['required'],
            'quantity' => ['required', 'integer'],
            'price' => ['required']
        ];
    }
}