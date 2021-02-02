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
            'identity_number'        => $data['identity_number'],
            'employee_id'            => $data['employee_id'],   
            'campaign_id'            => $data['campaign_id'],          
            'call_center_status_id'  => $data['call_center_status_id']
        ]);
    }
}
