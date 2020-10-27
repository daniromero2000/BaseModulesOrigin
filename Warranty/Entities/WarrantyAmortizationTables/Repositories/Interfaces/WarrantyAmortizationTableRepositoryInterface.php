<?php

namespace Modules\Warranty\Entities\WarrantyAmortizationTables\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyAmortizationTableRepositoryInterface
{
    public function createWarrantyAmortizationTable(array $data);

    public function updateWarrantyAmortizationTable(array $data);

    public function listWarrantyAmortizationTables($totalView): Support;
}
