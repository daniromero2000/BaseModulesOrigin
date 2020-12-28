<?php

namespace Modules\Libranza\Entities\Covenants\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Libranza\Entities\Covenants\Covenant;

interface CovenantRepositoryInterface
{
    public function getAllCovenantsNames();

    public function listCovenants($totalView);

    public function createCovenant(array $params): Covenant;

    public function updateCovenant(array $params);

    public function findCovenantById(int $id): Covenant;

    public function deleteCovenant($id): bool;

    public function searchCovenant(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCovenants(string $text = null,  $from = null, $to = null);
}
