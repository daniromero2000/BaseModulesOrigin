<?php

namespace Modules\Generals\Entities\Currencies;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
