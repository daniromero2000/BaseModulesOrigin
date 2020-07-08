<?php

namespace Modules\Companies\Entities\Permissions;

use Laratrust\Models\LaratrustPermission;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Permission extends LaratrustPermission
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'display_name',
        'icon',
        'description',
        'permission_group_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'relevance',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'permissions.name'         => 10,
            'permissions.display_name' => 10,
        ],
    ];

    public function searchPermission($term)
    {
        return self::search($term);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class)
            ->select(['id'], 'name', 'group_order', 'status');
    }
}
