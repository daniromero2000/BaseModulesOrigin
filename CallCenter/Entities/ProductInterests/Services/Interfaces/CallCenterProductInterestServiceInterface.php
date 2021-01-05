<?php

namespace Modules\CallCenter\Entities\ProductInterests\Services\Interfaces;

interface CallCenterProductInterestServiceInterface
{
    public function listProductInterests(array $data): array;

    public function saveProductInterest(array $data): bool;

    public function updateProductInterest(array $data): bool;

    public function deleteProductInterest(int $id): bool;
}
