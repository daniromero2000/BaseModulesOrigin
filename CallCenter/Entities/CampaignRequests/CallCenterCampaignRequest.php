<?php

namespace Modules\CallCenter\Entities\CampaignRequests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Companies\Entities\Employees\Employee;

class CallCenterCampaignRequest extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'call_center_campaign_requests';

    protected $fillable = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src',
        'status'
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

    public function employee()
    {
        return $this->belongsTo(Employee::class)->select('id', 'name', 'last_name');
    }
}
