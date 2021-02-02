<?php

namespace Modules\Courses\Entities\Campaigns\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\CallCenter\Entities\CampaignBases\CallCenterCampaignBase;

class CampaignImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CallCenterCampaignBase([
            'identity_number'        => $row['identity_number'],
            'employee_id'            => $row['employee_id'],   
            'campaign_id'            => $row['campaign_id'],          
            'call_center_status_id'  => $row['call_center_status_id']
        ]);
    }
}
