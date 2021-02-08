<?php

namespace Modules\CallCenter\Entities\CampaignBases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerSoats\CustomerSoat;
use Modules\Customers\Entities\CustomersOportudata\CustomerOportudata;

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

    public function customerOportudata()
    {
        return $this->belongsTo(CustomerOportudata::class, 'identity_number');
    }

    public function customerSoat()
    {
        return $this->belongsTo(CustomerSoat::class, 'identity_number');
    }
}
