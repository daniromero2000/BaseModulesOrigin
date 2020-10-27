<?php

namespace Modules\Warranty\Entities\WarrantyCases\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;
interface WarrantyCaseRepositoryInterface
{
    public function createWarrantyCase(array $params);

    public function updateWarrantyCase(array $data);

    public function listWarrantyCases($totalView): Support;
}
