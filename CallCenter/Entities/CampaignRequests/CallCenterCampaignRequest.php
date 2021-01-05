<?php

namespace Modules\CallCenter\Entities\CampaignRequests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterCampaignRequest extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_campaign_requests';

    protected $fillable = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];
}
