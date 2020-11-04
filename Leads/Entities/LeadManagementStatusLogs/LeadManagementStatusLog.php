<?php

namespace Modules\Leads\Entities\LeadManagementStatusLogs;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;

class LeadManagementStatusLog extends Model
{
    protected $fillable = [
        'id',
        'lead_id',
        'management_status_id',
        'employee_id',
        'created_at'
    ];

    protected $table  = 'lead_management_status';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function status()
    {
        return $this->belongsTo(ManagementStatus::class, 'management_status_id');
    }
}
