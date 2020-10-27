<?php

namespace Modules\CallCenter\Entities\CallCenterCampaigns;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;

class CallCenterCampaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'department_id',
        'begindate',
        'endingdate',
        'questionnary_id',
        'script_id',
    ];

    public function callCenterAssignments()
    {
        return $this->hasMany(CallCenterAssignment::class);
    }
}
