<?php

namespace Modules\Generals\Entities\ManagementStatuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagementStatus extends Model
{
    use SoftDeletes;

    protected $table = 'management_statuses';

    protected $fillable = [
        'status',
        'type_management_status',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
