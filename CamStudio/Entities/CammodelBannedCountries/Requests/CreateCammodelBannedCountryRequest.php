<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelBannedCountryRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => ['required'],
            'cammodel_id' => ['required'],
        ];
    }
}
