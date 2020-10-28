<?php

namespace Modules\Leads\Entities\LeadManagementStatusesLogs;

use Modules\Leads\Entities\Leads\Lead;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;

class LeadManagementStatusesLog extends Model
{
    protected $fillable = [
        'id',
        'lead_id',
        'status_management_id',
        'created_at',
        'user_id'
    ];

    protected $table  = 'lead_management_status';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ManagementStatus()
    {
        return $this->belongsTo(ManagementStatus::class, 'management_status_id');
    }
}
