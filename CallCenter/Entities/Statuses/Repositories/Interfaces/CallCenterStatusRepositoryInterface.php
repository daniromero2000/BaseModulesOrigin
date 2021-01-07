<?php

namespace Modules\CallCenter\Entities\Statuses\Repositories\Interfaces;

use Modules\CallCenter\Entities\Statuses\CallCenterStatus;
use Illuminate\Support\Collection;

interface CallCenterStatusRepositoryInterface
{
    public function listCallCenterStatuses(int $totalView);

    public function createCallCenterStatus(array $params): CallCenterStatus;

    public function findCallCenterStatusById(int $id): CallCenterStatus;

    public function findTrashedCallCenterStatusById(int $id): CallCenterStatus;

    public function updateCallCenterStatus(array $params): bool;

    public function searchCallCenterStatus(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterStatuses(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterStatus(string $text = null): Collection;

    public function deleteCallCenterStatus(): bool;

    public function recoverTrashedCallCenterStatus(): bool;
}
