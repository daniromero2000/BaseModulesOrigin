<?php

namespace Modules\Companies\Entities\Permissions\Repositories;

use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'display_name', 'icon', 'description'];

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getAllPermissionNames(): Collection
    {
        try {
            return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createPermission(array $data): Permission
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findPermissionById(int $id): Permission
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findTrashedPermissionById(int $id): Permission
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatePermission(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deletePermission(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listPermissions(int $totalView): Collection
    {
        try {
            return  $this->model->orderBy('display_name', 'asc')
                ->skip($totalView)->take(30)->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchPermission(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->get($this->columns);
            }
            return $this->model->searchPermission($text)->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedPermission(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->onlyTrashed($text)->get($this->columns);
            }
            return $this->model->onlyTrashed()->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedPermission(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
