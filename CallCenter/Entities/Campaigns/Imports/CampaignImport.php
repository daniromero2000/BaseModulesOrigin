<?php

namespace Modules\Courses\Entities\Campaigns\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\CallCenter\Entities\Campaigns\CallCenterCampaign;

class CampaignImport implements ToModel
{
    public function model(array $row)
    {
        dd($row);
        return new CallCenterCampaign([
            'name'        => $row['test']           
        ]);
    }
}
