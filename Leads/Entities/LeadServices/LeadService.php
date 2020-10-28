<?php

namespace Modules\Leads\Entities\LeadServices;

use Modules\Leads\Entities\LeadAreas\LeadArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadService extends Model
{
    use SoftDeletes;

    protected $table = 'lead_services';

    protected $fillable = [
        'id',
        'service',
    ];

    public function leadArea()
    {
        return $this->belongsToMany(LeadArea::class)->withTimestamps();
    }
}
