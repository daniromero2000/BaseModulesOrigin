<?php

namespace Modules\CallCenter\Entities\ManagementIndicators;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\Managements\CallCenterManagement;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterManagementIndicator extends Model
{
    use SoftDeletes;

    protected $table = 'callcenter_management_indicators';

    protected $fillable = [
        'indicator',
        'status'
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

    public function callCenterManagements()
    {
         $this->hasMany(CallCenterManagement::class);
    }
}
