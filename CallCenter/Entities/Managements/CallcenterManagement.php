<?php

namespace Modules\CallCenter\Entities\Managements;
use Modules\CallCenter\Entities\CallQualifications\CallCenterCallQualification;
use Modules\CallCenter\Entities\ManagementIndicators\CallCenterManagementIndicator;
use Modules\CallCenter\Entities\ManagementComments\CallCenterCommentManagement;
use Modules\CallCenter\Entities\Scripts\CallCenterScript;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterManagement extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_managements';

    protected $fillable = [
        'identification',
        'name_answer',
        'email_answer',
        'comment',
        'user_id',
        'campaign_id',
        'script_id',
        'questionnaire_id',
        'call_qualification_id',
        'management_indicator_id'
       ];
   
       protected $hidden = [
           'id',
           'update_at',
           'deleted_at',
           'status'
       ];
   
       protected $guarded = [
           'id',
           'created_at',
           'updated_at',
           'deleted_at'
       ];
   
       protected $dates = [
           'created_at',
           'updated_at',
           'deleted_at'
       ];
          
       public function callCenterScript()
       {
            return $this->belongsTo(CallCenterScript::class);
       }
   
       public function callCenterManagementIndicator()
       {
            return $this->belongsTo(CallCenterManagementIndicator::class);
       }
   
       public function callCenterCallQualification()
       {
            return $this->belongsTo(CallCenterCallQualification::class);
       }

       public function callCenterCommentManagement()
       {
            return $this->hasMany(CallCenterCommentManagement::class);           
       }
}
