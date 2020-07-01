<?php

namespace Modules\Ecommerce\Entities\Cart\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

/**
 * Class CartCheckoutRequest
 * @package Modules\Ecommerce\Entities\Cart\Requests
 * @codeCoverageIgnore
 */
class CartCheckoutRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing_address' => ['required']
        ];
    }
}
