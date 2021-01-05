<?php

namespace Modules\CallCenter\Entities\Statuses\Services\Interfaces;

interface CallCenterStatusServiceInterface
{
    public function listStatuses(array $data): array;

    public function saveStatus(array $data): bool;

    public function updateStatus(array $data): bool;

    public function deleteStatus(int $id): bool;
}
