<?php

namespace Modules\CallCenter\Entities\Campaigns;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;
class CallCenterCampaign extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_campaigns';

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
