<?php

namespace Modules\CallCenter\Entities\CallQualifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CallCenter\Entities\Managements\CallCenterManagement;

class CallcenterCallQualification extends Model
{
    use SoftDeletes;

    protected $table = 'call_center_call_qualifications';

    protected $fillable = [
        'qualification',
        'status'
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
        'deleted_at',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function callCenterManagements()
    {
         $this->hasMany(CallCenterManagement::class);
    }
}
