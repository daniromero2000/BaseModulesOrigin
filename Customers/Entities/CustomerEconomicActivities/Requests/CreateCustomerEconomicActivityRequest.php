<?php

namespace Modules\Customers\Entities\CustomerEconomicActivities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEconomicActivityRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'customer_id'               => ['required', 'bail'],
            'economic_activity_type_id' => ['required', 'bail'],
            'entity_name'               => ['required', 'max:255', 'bail'],
            'professions_list_id'       => ['required', 'bail'],
            'start_date'                => ['required', 'date', 'bail'],
            'incomes'                   => ['required', 'max:255', 'bail'],
            'other_incomes'             => ['required', 'max:255', 'bail'],
            'other_incomes_source'      => ['required', 'max:255', 'bail'],
            'expenses'                  => ['required', 'max:255', 'bail'],
            'entity_address'            => ['required', 'max:255', 'bail'],
            'entity_phone'              => ['required', 'max:255', 'bail'],
            'city_id'                   => ['required'],
        ];
    }
}
