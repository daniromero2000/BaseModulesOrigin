<?php

namespace Modules\Companies\Entities\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Action extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'actions';

    protected $fillable = [
        'permission_id',
        'name',
        'button',
        'icon',
        'route',
        'principal'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
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
            'actions.name'             => 10,
            'actions.route'            => 5,
            'permissions.display_name' => 10
        ],
        'joins' => [
            'permissions' => ['permissions.id', 'actions.permission_id'],
        ],
    ];

    public function searchAction($term)
    {
        return self::search($term);
    }

    public function role()
    {
        return $this->belongsToMany(Action::class, 'action_role', 'action_id', 'role_id')->select(['action_id', 'role_id', 'status']);
    }
}
