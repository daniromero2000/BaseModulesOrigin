<?php

namespace Modules\Ecommerce\Entities\ProductReviews\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateProductReviewRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => ['required'],
            'product_id' => ['required'],
            'customer_id' => ['required'],
        ];
    }
}
