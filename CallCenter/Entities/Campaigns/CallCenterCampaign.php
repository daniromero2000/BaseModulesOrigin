<?php

namespace Modules\CallCenter\Entities\Campaigns;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CallCenter\Entities\Questionnaires\CallCenterQuestionnaire;
use Modules\CallCenter\Entities\Scripts\CallCenterScript;
use Modules\Companies\Entities\Departments\Department;
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function script()
    {
        return $this->belongsTo(CallCenterScript::class, 'script_id');
    }

    public function questionnare()
    {
        return $this->belongsTo(CallCenterQuestionnaire::class, 'questionnary_id');
    }

}
