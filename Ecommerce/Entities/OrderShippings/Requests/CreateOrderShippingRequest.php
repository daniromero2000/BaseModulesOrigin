<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderShippingRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => ['required'],
            'courier_id' => ['required'],
            'total_qty' => ['required'],
        ];
    }
}
