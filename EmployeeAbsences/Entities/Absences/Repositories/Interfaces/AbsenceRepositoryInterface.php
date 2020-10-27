<?php

namespace Modules\EmployeeAbsences\Entities\Absences\Repositories\Interfaces;

use Modules\EmployeeAbsences\Entities\Absences\Absence;
use Illuminate\Support\Collection;

interface AbsenceRepositoryInterface
{
    public function listAbsence(int $totalView);

    public function createAbsence(array $params): Absence;

    public function findAbsenceById(int $id): Absence;

    public function findTrashedAbsenceById(int $id): Absence;

    public function updateAbsence(array $data): bool;

    public function getAllAbsenceTimes(): Collection;

    public function searchTrashedAbsence(string $text): Collection;

    public function deleteAbsence(): bool;

    public function searchAbsence(string $text): Collection;

    public function recoverTrashedAbsence(): bool;
}
