<?php

namespace Modules\Courses\Entities\Campaigns\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\CallCenter\Entities\Campaigns\CallCenterCampaign;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampaignImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CallCenterCampaign([
            'identity_number'        => $row['identity_number'],
            'employee_id'            => $row['employee_id'],   
            'campaign_id'            => $row['campaign_id'],          
            'call_center_status_id'  => $row['call_center_status_id']
        ]);
    }
}
