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
            $row           
        ]);
    }
}
