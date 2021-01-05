<?php

namespace Modules\CallCenter\Entities\ProductInterests\Repositories\Interfaces;

use Modules\CallCenter\Entities\ProductInterests\CallCenterProductInterest;
use Illuminate\Support\Collection;

interface CallCenterProductInterestRepositoryInterface
{
    public function listCallCenterProductInterests(int $totalView);

    public function createCallCenterProductInterest(array $params): CallCenterProductInterest;

    public function findCallCenterProductInterestById(int $id): CallCenterProductInterest;

    public function findTrashedCallCenterProductInterestById(int $id): CallCenterProductInterest;

    public function updateCallCenterProductInterest(array $params): bool;

    public function searchCallCenterProductInterest(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterProductInterests(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterProductInterest(string $text = null): Collection;

    public function deleteCallCenterProductInterest(): bool;

    public function recoverTrashedCallCenterProductInterest(): bool;
}
