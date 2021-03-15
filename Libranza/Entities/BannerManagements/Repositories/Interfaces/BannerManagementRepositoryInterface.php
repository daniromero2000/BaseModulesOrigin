<?php

namespace Modules\Libranza\Entities\BannerManagements\Repositories\Interfaces;

use Modules\Libranza\Entities\BannerManagements\BannerManagement;
use Illuminate\Support\Collection;

interface BannerManagementRepositoryInterface
{
    public function listBannerManagements(int $totalView);

    public function listBannerManagementsForFront();

    public function createBannerManagement(array $params): BannerManagement;

    public function findBannerManagementById(int $id): BannerManagement;

    public function findTrashedBannerManagementById(int $id): BannerManagement;

    public function updateBannerManagement(array $params): bool;

    public function saveImage($params): string;

    public function searchBannerManagement(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countBannerManagements(string $text = null,  $from = null, $to = null);

    public function searchTrashedBannerManagement(string $text = null): Collection;

    public function deleteBannerManagement(): bool;

    public function updateSortOrder(array $data);

    public function recoverTrashedBannerManagement(): bool;
}
