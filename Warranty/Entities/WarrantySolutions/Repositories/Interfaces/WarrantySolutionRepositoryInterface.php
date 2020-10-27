<?php

namespace Modules\Warranty\Entities\WarrantySolutions\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantySolutionRepositoryInterface
{
    public function createWarrantySolution(array $params);

    public function updateWarrantySolution(array $data);

    public function listWarrantySolutions($totalView): Support;
}