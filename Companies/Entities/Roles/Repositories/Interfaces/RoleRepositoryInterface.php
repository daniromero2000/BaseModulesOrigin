<?php

namespace Modules\Companies\Entities\Roles\Repositories\Interfaces;

use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function getAllRoleNames(): Collection;

    public function createRole(array $data): Role;

    public function listRoles(int $totalView): Collection;

    public function findRoleById(int $id): Role;

    public function findTrashedRoleById(int $id): Role;

    public function updateRole(array $data): bool;

    public function searchRole(string $text): Collection;

    public function deleteRoleById(): bool;

    public function attachToPermission(Permission $permission);

    public function attachToPermissions(...$permissions);

    public function syncPermissions(array $ids);

    public function listPermissions(): Collection;

    public function recoverTrashedRole(): bool;

    public function searchTrashedRole(string $text): Collection;
}
