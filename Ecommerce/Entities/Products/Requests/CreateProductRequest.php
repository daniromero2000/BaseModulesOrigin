<?php

namespace Modules\Ecommerce\Entities\Products\Requests;

use Illuminate\Validation\Rule;
use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
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
            'quantity' => ['required', 'numeric'],
            'price' => ['required'],
            'cover' => ['required', 'file', 'image:png,jpeg,jpg,gif']
        ];
    }
}