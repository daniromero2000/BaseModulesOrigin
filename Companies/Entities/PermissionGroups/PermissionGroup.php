<?php

namespace Modules\Companies\Entities\PermissionGroups;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Permissions\Permission;

class PermissionGroup extends Model
{
    use SoftDeletes;
    protected $table = 'permission_groups';

    public $fillable = [
        'name',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
