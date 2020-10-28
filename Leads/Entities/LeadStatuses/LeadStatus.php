<?php

namespace Modules\Leads\Entities\LeadStatuses;

use Modules\Leads\Entities\LeadAreas\LeadArea;
use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;


class LeadStatus extends Model
{
    protected $table = 'lead_statuses';

    protected $fillable = [
        'name',
        'color',
    ];

    protected $hidden = [];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function leadArea()
    {
        return $this->belongsToMany(LeadArea::class)->withTimestamps();
    }
}
