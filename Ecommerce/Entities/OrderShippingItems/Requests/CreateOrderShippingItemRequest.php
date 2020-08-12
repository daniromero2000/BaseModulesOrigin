<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderShippingItemsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'sku' => ['required'],
            'qty' => ['required'],
        ];
    }
}
