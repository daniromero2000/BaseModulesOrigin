<?php

namespace Modules\Warranty\Entities\WarrantyTypes\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyTypeRepositoryInterface
{
    public function createWarrantyType(array $params);

    public function updateWarrantyType(array $data);

    public function listWarrantyTypes($totalView): Support;
}