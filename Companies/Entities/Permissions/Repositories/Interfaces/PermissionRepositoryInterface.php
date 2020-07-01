<?php

namespace Modules\Companies\Entities\Permissions\Repositories\Interfaces;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function getAllPermissionNames(): Collection;

    public function createPermission(array $data);

    public function findPermissionById(int $id): Permission;

    public function findTrashedPermissionById(int $id): Permission;

    public function updatePermission(array $data): bool;

    public function deletePermission(): bool;

    public function listPermissions(int $totalView): Collection;

    public function searchPermission(string $text): Collection;

    public function searchTrashedPermission(string $text): Collection;

    public function recoverTrashedPermission(): bool;
}
