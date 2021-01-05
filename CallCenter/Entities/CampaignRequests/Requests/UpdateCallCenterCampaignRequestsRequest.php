<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCallCenterCampaignRequestsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'    => ['required', 'max:255', 'bail']
        ];
    }
}
