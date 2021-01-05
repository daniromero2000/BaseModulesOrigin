<?php

namespace Modules\CallCenter\Entities\Managements\Services\Interfaces;

interface CallCenterManagementServiceInterface
{
    public function listManagements(array $data): array;

    public function saveManagement(array $data): bool;

    public function updateManagement(array $data): bool;

    public function deleteManagement(int $id): bool;
}
