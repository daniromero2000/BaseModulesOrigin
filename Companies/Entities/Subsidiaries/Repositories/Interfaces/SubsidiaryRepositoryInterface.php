<?php

namespace Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Support\Collection;

interface SubsidiaryRepositoryInterface
{
    public function getAllSubsidiaryNames(): Collection;

    public function getSubsidiaryForCompany($company): Collection;

    public function listSubsidiaries(int $totalView, $company);

    public function createSubsidiary(array $params): Subsidiary;

    public function updateSubsidiary(array $params): bool;

    public function findSubsidiaryById(int $id): Subsidiary;

    public function findTrashedSubsidiaryById(int $id): Subsidiary;

    public function deleteSubsidiary(): bool;

    public function searchSubsidiary(string $text = null, int $totalView, $company, $from = null, $to = null): Collection;

    public function countSubsidiaries(string $text = null, $company,  $from = null, $to = null);

    public function recoverTrashedSubsidiary(): bool;
}
