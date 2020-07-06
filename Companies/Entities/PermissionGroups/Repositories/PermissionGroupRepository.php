<?php

namespace Modules\Companies\Entities\PermissionGroups\Repositories;

use Modules\Companies\Entities\PermissionGroups\PermissionGroup;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionGroupRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class PermissionGroupRepository implements PermissionGroupRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'group_order'];

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->model = $permissionGroup;
    }

    public function getAllPermissionGroups(): Collection
    {
        try {
            return $this->model->orderBy('name', 'asc')->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createPermissionGroup(array $data): PermissionGroup
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
