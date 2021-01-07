<?php

namespace Modules\CallCenter\Entities\CallQualifications\Services\Interfaces;

interface CallCenterCallQualificationServiceInterface
{
    public function listCallQualifications(array $data): array;

    public function saveCallQualification(array $data): bool;

    public function updateCallQualification(array $data): bool;

    public function deleteCallQualification(int $id): bool;
}
