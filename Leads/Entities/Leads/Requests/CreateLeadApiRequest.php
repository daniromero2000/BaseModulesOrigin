<?php

namespace Modules\Leads\Entities\Leads\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateLeadApiRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'                 => ['required', 'max:255', 'bail'],
            'last_name'            => ['required', 'max:255', 'bail'],
            'phone'                => ['max:255'],
            'is_active'            => ['max:3'],
            'employee_position_id' => ['required']
        ];
    }
}
