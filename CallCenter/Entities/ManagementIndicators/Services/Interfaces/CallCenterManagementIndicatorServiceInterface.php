<?php

namespace Modules\CallCenter\Entities\ManagementIndicators\Services\Interfaces;

interface CallCenterManagementIndicatorServiceInterface
{
    public function listManagementIndicators(array $data): array;

    public function saveManagementIndicator(array $data): bool;

    public function updateManagementIndicator(array $data): bool;

    public function deleteManagementIndicator(int $id): bool;
}
