<?php

namespace Modules\CallCenter\Entities\Assignments;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\CallCenterCampaign;
use Modules\Companies\Entities\Employees\Employee;

class CallCenterAssignment extends Model
{
    protected $fillable = [
        'employe_id',
        'call_center_campaign_id',
        'identity_number'        
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'    
    ];

    public function callCenterCampaign()
    {
        return $this->hasOne(CallCenterCampaign::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

}