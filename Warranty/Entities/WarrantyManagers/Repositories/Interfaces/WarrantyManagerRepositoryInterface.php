<?php

namespace Modules\Warranty\Entities\WarrantyManagers\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyManagerRepositoryInterface
{
    public function createWarrantyManager(array $data);

    public function updateWarrantyManager(array $data);

    public function listWarrantyManagers($totalView): Support;
}
