<?php

namespace Modules\Companies\Entities\CompanyReviews\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCompanyReviewRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'bail', 'max:255'],
            'title' => ['required', 'bail', 'max:255'],
            'rating' => ['required', 'bail'],
            'comment' => ['required', 'bail'],
            'company_id' => ['required', 'bail'],
            'customer_id' => ['required', 'bail'],
        ];
    }
}
