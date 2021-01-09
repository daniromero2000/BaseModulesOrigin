<?php

namespace Modules\Companies\Entities\Roles\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'display_name', 'description'];

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getAllRoleNames(): Collection
    {
        try {
            return $this->model->where('status', 1)->orderBy('name', 'desc')
                ->get(['id', 'display_name']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listRoles(int $totalView): Collection
    {
        return  $this->model->orderBy('name', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createRole(array $data): Role
    {
        try {
            $role = new Role($data);
            $role->save();
            return $role;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findRoleById(int $id): Role
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findTrashedRoleById(int $id): Role
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateRole(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchRole(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listRoles($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchRole($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchRole($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countRoles(string $text = null,  $from = null, $to = null)
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                $data =  $this->model->get(['id']);
                return count($data);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchRole($text, null, true, true)
                    ->get(['id']);
                return count($data);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchRole($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function deleteRoleById(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function attachToPermission(Permission $permission)
    {
        $this->model->attachPermission($permission);
    }

    public function attachToPermissions(...$permissions)
    {
        $this->model->attachPermissions($permissions);
    }

    public function syncPermissions(array $ids)
    {
        $this->model->syncPermissions($ids);
    }

    public function syncActions(array $ids)
    {
        $this->model->action()->sync($ids);
    }

    public function listPermissions(): Collection
    {
        try {
            return $this->model->permissions()->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
