<?php

namespace Modules\Companies\Entities\ActionRole;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionRole extends Model
{
    use SoftDeletes;
    protected $table = 'action_role';

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $fillable = [
        'action_id',
        'role_id'
    ];

    protected $guarded  = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];
}
