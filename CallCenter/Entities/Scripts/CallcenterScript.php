<?php

namespace Modules\CallCenter\Entities\Scripts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CallCenter\Entities\Managements\CallCenterManagement;

class CallCenterScript extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_scripts';

    protected $fillable = [
        'script',
        'name',
        'is_active',
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
    
    public function callCenterCampaigns()
    {
         $this->hasMany(CallCenterCampaign::class);
    }
}
