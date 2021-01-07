<?php

namespace Modules\CallCenter\Entities\Schedules\Repositories\Interfaces;

use Modules\CallCenter\Entities\Schedules\CallCenterSchedule;
use Illuminate\Support\Collection;

interface CallCenterScheduleRepositoryInterface
{
    public function listCallCenterSchedules(int $totalView);

    public function createCallCenterSchedule(array $params): CallCenterSchedule;

    public function findCallCenterScheduleById(int $id): CallCenterSchedule;

    public function findTrashedCallCenterScheduleById(int $id): CallCenterSchedule;

    public function updateCallCenterSchedule(array $params): bool;

    public function searchCallCenterSchedule(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterSchedules(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterSchedule(string $text = null): Collection;

    public function deleteCallCenterSchedule(): bool;

    public function recoverTrashedCallCenterSchedule(): bool;
}
