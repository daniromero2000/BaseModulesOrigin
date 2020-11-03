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
        'lead_id',
        'kind_of_person',
        'entity',
        'amount',
        'term',
        'expiration_date_soat',
        'subsidiary_id'
    ];
}
