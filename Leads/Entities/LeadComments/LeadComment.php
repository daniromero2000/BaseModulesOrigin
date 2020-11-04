<?php

namespace Modules\Leads\Entities\LeadComments;

use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Employees\Employee;

class LeadComment extends Model
{
    protected $fillable = [
        'lead_id',
        'comment',
        'employee_id'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
