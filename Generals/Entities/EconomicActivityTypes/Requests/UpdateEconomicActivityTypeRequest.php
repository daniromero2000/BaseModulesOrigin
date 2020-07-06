<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateEconomicActivityTypeRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'economic_activity_type' => ['required']
        ];
    }
}
