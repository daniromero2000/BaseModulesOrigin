<?php

namespace Modules\Companies\Entities\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Permissions\Permission;
use Nicolaslopezj\Searchable\SearchableTrait;

class Action extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'actions';

    protected $fillable = [
        'permission_id',
        'name',
        'icon',
        'route',
        'principal',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'is_active'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'actions.name' => 10,
            'actions.route' => 10
        ]
    ];

    public function searchAction($term)
    {
        return self::search($term);
    }

    public function role()
    {
        return $this->belongsToMany(Action::class, 'action_role', 'action_id', 'role_id')
            ->select(['action_id', 'role_id', 'status']);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class)
            ->select(['id', 'name', 'display_name', 'icon', 'description', 'status', 'created_at']);
    }
}
