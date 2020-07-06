<?php

namespace Modules\Companies\Entities\Permissions\Repositories\Interfaces;

use Modules\Companies\Entities\PermissionGroups\PermissionGroup;
use Illuminate\Support\Collection;

interface PermissionGroupRepositoryInterface
{
    public function getAllPermissionGroups(): Collection;

    public function createPermissionGroup(array $data): PermissionGroup;
}
