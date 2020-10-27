<?php

namespace Modules\Warranty\Entities\WarrantyDocuments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyDocumentRepositoryInterface
{
    public function createWarrantyDocument(array $data);

    public function updateWarrantyDocument(array $data);

    public function listWarrantyDocuments($totalView): Support;
}
