<?php

namespace Modules\Leads\Entities\LeadComments;

use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{
    protected $fillable = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
