<?php

namespace Modules\Ecommerce\Entities\Categories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:categories']
        ];
    }
}
