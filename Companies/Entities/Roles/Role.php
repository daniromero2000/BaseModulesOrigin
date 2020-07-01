<?php

namespace Modules\Companies\Entities\Roles;

use Laratrust\Models\LaratrustRole;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends LaratrustRole
{
    use Notifiable, SoftDeletes, SearchableTrait;
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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
            'roles.name'         => 10,
            'roles.display_name' => 10,
        ],
    ];

    public function searchRole($term)
    {
        return self::search($term);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id')->orderBy('name', 'asc');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'action_role', 'role_id', 'action_id');
    }

    public function user()
    {
        return $this->belongsToMany(Employee::class, 'role_user', 'role_id', 'user_id');
    }
}
