<?php

namespace Modules\Warranty\Entities\WarrantyExchangeItems\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyExchangeItemRepositoryInterface
{
    public function createWarrantyExchangeItem(array $data);

    public function updateWarrantyExchangeItem(array $data);

    public function listWarrantyExchangeItems($totalView): Support;
}
