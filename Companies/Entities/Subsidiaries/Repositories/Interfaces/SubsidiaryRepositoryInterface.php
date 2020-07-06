<?php

namespace Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Support\Collection;

interface SubsidiaryRepositoryInterface
{
    public function getAllSubsidiaryNames(): Collection;

    public function listSubsidiaries(int $totalView);

    public function createSubsidiary(array $params): Subsidiary;

    public function updateSubsidiary(array $params): bool;

    public function findSubsidiaryById(int $id): Subsidiary;

    public function findTrashedSubsidiaryById(int $id): Subsidiary;

    public function deleteSubsidiary(): bool;

    public function searchSubsidiary(string $text): Collection;

    public function recoverTrashedSubsidiary(): bool;
}
