<?php

namespace Modules\CallCenter\Entities\ProductInterestComments\Services\Interfaces;

interface CallCenterProductInterestCommentServiceInterface
{
    public function listProductInterestComments(array $data): array;

    public function saveProductInterestComment(array $data): bool;

    public function updateProductInterestComment(array $data): bool;

    public function deleteProductInterestComment(int $id): bool;
}
