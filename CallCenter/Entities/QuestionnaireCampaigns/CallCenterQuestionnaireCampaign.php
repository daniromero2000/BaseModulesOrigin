<?php

namespace Modules\CallCenter\Entities\QuestionnaireCampaigns;

use Illuminate\Database\Eloquent\Model;

class CallCenterQuestionnaireCampaign extends Model
{
    protected $table = 'call_center_questionnaire_campaigns';

    protected $fillable = [
        'id_questionnaire',
        'id_campaign',
    ];
    
    protected $hidden = [
        'id',
        'update_at',
        'status'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];    
}
