<?php

namespace Modules\CallCenter\Entities\Schedules\Services\Interfaces;

interface CallCenterScheduleServiceInterface
{
    public function listSchedules(array $data): array;

    public function saveSchedule(array $data): bool;

    public function updateSchedule(array $data): bool;

    public function deleteSchedule(int $id): bool;
}
