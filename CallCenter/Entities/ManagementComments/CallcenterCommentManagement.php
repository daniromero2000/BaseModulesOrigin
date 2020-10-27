<?php

namespace Modules\CallCenter\Entities\ManagementComments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CallCenter\Entities\Managements\CallCenterManagement;

class CallCenterCommentManagement extends Model
{

    use SoftDeletes;
    protected $table = 'callcenter_comment_managements';

    protected $fillable = [
        'callcenter_management_id',
        'comment',
        'employee_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'id',
        'status',
        'update_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function callCenterManagement()
    {
         $this->belongsTo(CallCenterManagement::class);
    }

}
