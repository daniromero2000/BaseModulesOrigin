<?php

namespace Modules\Courses\Entities\Campaigns\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\CallCenter\Entities\CampaignBases\CallCenterCampaignBase;

class CampaignImport implements ToModel, WithHeadingRow
{
    public function model(array $data)
    {
        return new CallCenterCampaignBase([
            'identity_number'        => $data['data']['identity_number'],
            'employee_id'            => $data['data']['employee_id'],   
            'campaign_id'            => $data['campaign'],          
            'call_center_status_id'  => $data['data']['call_center_status_id']
        ]);
    }
}
