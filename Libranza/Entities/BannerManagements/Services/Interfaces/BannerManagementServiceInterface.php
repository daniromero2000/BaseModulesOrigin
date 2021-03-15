<?php

namespace Modules\Libranza\Entities\BannerManagements\Services\Interfaces;

interface BannerManagementServiceInterface
{
    public function listManagements(array $data): array;

    public function saveManagement(array $data): bool;

    public function updateManagement(array $data): bool;

    public function deleteManagement(int $id): bool;

    public function updateSortOrder( $data): bool;

    public function showManagement(int $id);

    public function listFront();
}
