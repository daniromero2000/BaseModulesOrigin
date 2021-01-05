<?php

namespace Modules\CallCenter\Entities\Managements\Repositories\Interfaces;

use Modules\CallCenter\Entities\Managements\CallCenterManagement;
use Illuminate\Support\Collection;

interface CallCenterManagementRepositoryInterface
{
    public function listCallCenterManagements(int $totalView);

    public function createCallCenterManagement(array $params): CallCenterManagement;

    public function findCallCenterManagementById(int $id): CallCenterManagement;

    public function findTrashedCallCenterManagementById(int $id): CallCenterManagement;

    public function updateCallCenterManagement(array $params): bool;

    public function searchCallCenterManagement(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterManagements(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterManagement(string $text = null): Collection;

    public function deleteCallCenterManagement(): bool;

    public function recoverTrashedCallCenterManagement(): bool;
}
