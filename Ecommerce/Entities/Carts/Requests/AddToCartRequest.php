<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class AddToCartRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => ['required', 'integer'],
            'quantity' => ['required', 'integer']
        ];
    }
}