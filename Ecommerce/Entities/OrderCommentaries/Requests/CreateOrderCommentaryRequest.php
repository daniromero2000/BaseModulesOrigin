<?php

namespace  Modules\Ecommerce\Entities\OrderCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderCommentaryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'order_id' => ['required', 'bail'],
            'commentary'  => ['required', 'max:255', 'bail'],
        ];
    }
}
