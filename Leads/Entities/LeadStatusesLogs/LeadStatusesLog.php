<?php

namespace Modules\Leads\Entities\LeadStatusesLogs;

use Modules\Leads\Entities\Leads\Lead;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Employees\Employee;

class LeadStatusesLog extends Model
{
    protected $table  = 'lead_statuses_logs';

    protected $fillable = [
        'id',
        'lead_id',
        'lead_statuses_id',
        'created_at',
        'updated_at',
        'employee_id'
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_statuses_id');
    }
}
