<?php

namespace Modules\Generals\Entities\Banks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $table = 'banks';

    protected $fillable = [
        'name',
        'country_id',
        'is_active'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'status',
        'updated_at',
    ];
}
