<?php

namespace Modules\CallCenter\Entities\CampaignBases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterCampaignBase extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_campaign_bases';

    protected $fillable = [
        'identity_number',
        'employee_id',
        'campaign_id',
        'call_center_status_id'
    ];
}
