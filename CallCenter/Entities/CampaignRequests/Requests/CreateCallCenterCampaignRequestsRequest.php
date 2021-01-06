<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCallCenterCampaignRequestsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'campaign'   => ['required', 'max:255', 'bail'],
        ];
    }
}
