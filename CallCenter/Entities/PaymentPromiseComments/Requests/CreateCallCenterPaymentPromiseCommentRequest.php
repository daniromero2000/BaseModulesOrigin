<?php

namespace Modules\CallCenter\Entities\PaymentPromiseComments\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCallCenterPaymentPromiseCommentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'   => ['required', 'max:255', 'bail'],
        ];
    }
}
