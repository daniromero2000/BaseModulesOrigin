<?php

namespace Modules\Leads\Entities\LeadInformations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadInformation extends Model
{
    use SoftDeletes;

    protected $table = 'lead_informations';

    protected $fillable = [
        'id',
        'area'
    ];
}
