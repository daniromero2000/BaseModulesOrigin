<?php

namespace Modules\Leads\Entities\LeadAreas;

use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;
use Modules\Leads\Entities\LeadServices\LeadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadArea extends Model
{
    use SoftDeletes;

    protected $table = 'lead_areas';

    protected $fillable = [
        'id',
        'area'
    ];

    public function leadStatuses()
    {
        return $this->belongsToMany(LeadStatus::class)->withTimestamps();
    }

    public function LeadServices()
    {
        return $this->belongsToMany(LeadService::class)->withTimestamps();
    }

    public function leadProduct()
    {
        return $this->belongsToMany(LeadProduct::class)->withTimestamps();
    }
}
