<?php

namespace Modules\Warranty\Entities\WarrantyChanges\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyChangeRepositoryInterface
{
    public function createWarrantyChanges(array $data);

    public function updateWarrantyChanges(array $data);

    public function listWarrantyChanges($totalView): Support;
}
