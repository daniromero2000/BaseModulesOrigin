<?php

namespace Modules\CallCenter\Entities\CampaignRequests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class CallCenterCampaignRequest extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'call_center_campaign_requests';

    protected $fillable = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    protected $searchable = [
        'columns' => [
            'call_center_campaign_requests.campaign'    => 10,
        ]
    ];

    public function searchCallCenterCampaignRequest($term)
    {
        return self::search($term);
    }
}
