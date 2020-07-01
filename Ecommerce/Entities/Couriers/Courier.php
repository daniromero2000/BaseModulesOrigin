<?php

namespace Modules\Ecommerce\Entities\Couriers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use SoftDeletes;
    protected $table = 'couriers';

    protected $fillable = [
        'name',
        'description',
        'url',
        'is_free',
        'cost',
        'status'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
