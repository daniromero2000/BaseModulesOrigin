<?php

namespace Modules\CallCenter\Entities\ManagementIndicators\Repositories\Interfaces;

use Modules\CallCenter\Entities\ManagementIndicators\CallCenterManagementIndicator;
use Illuminate\Support\Collection;

interface CallCenterManagementIndicatorRepositoryInterface
{
    public function listCallCenterManagementIndicators(int $totalView);

    public function createCallCenterManagementIndicator(array $params): CallCenterManagementIndicator;

    public function findCallCenterManagementIndicatorById(int $id): CallCenterManagementIndicator;

    public function findTrashedCallCenterManagementIndicatorById(int $id): CallCenterManagementIndicator;

    public function updateCallCenterManagementIndicator(array $params): bool;

    public function searchCallCenterManagementIndicator(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterManagementIndicators(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterManagementIndicator(string $text = null): Collection;

    public function deleteCallCenterManagementIndicator(): bool;

    public function recoverTrashedCallCenterManagementIndicator(): bool;
}
