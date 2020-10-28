<?php

namespace Modules\Leads\Entities\LeadChannels;

use Illuminate\Database\Eloquent\Model;

class LeadChannel extends Model
{
    protected $table = 'lead_channels';

    protected $fillable = [
        'id',
        'channel'
    ];
}
