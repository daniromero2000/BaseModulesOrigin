<?php

namespace Modules\Ecommerce\Entities\Brands\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Collection;

interface BrandRepositoryInterface
{
    public function createBrand(array $data): Brand;

    public function findBrandById(int $id): Brand;

    public function updateBrand(array $data): bool;

    public function deleteBrand(): bool;

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function saveProduct(Product $product);
}
