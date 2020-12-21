<?php

namespace Modules\Generals\Entities\Covenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Covenant extends Model
{
    use SoftDeletes;
    protected $table = 'covenants';

    protected $fillable = [
        'covenant',
        'type',
        'kind_of_person',
        'origin',
        'is_active',
        'company_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

}
