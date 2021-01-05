<?php

namespace Modules\CallCenter\Entities\CallQualifications\Repositories\Interfaces;

use Modules\CallCenter\Entities\CallQualifications\CallCenterCallQualification;
use Illuminate\Support\Collection;

interface CallCenterCallQualificationRepositoryInterface
{
    public function listCallCenterCallQualifications(int $totalView);

    public function createCallCenterCallQualification(array $params): CallCenterCallQualification;

    public function findCallCenterCallQualificationById(int $id): CallCenterCallQualification;

    public function findTrashedCallCenterCallQualificationById(int $id): CallCenterCallQualification;

    public function updateCallCenterCallQualification(array $params): bool;

    public function searchCallCenterCallQualification(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterCallQualifications(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterCallQualification(string $text = null): Collection;

    public function deleteCallCenterCallQualification(): bool;

    public function recoverTrashedCallCenterCallQualification(): bool;
}
