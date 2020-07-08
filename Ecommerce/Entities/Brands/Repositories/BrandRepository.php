<?php

namespace Modules\Ecommerce\Entities\Brands\Repositories;

use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Brands\Exceptions\BrandNotFoundErrorException;
use Modules\Ecommerce\Entities\Brands\Exceptions\CreateBrandErrorException;
use Modules\Ecommerce\Entities\Brands\Exceptions\UpdateBrandErrorException;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'slug',
        'logo',
        'is_active'
    ];

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    public function createBrand(array $data): Brand
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBrandErrorException($e);
        }
    }

    public function findBrandById(int $id): Brand
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new BrandNotFoundErrorException($e);
        }
    }

    public function updateBrand(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateBrandErrorException($e);
        }
    }

    public function deleteBrand(): bool
    {
        return $this->model->delete();
    }

    public function listBrands($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->all($this->columns, $orderBy, $sortBy);
    }

    public function listProducts(): Collection
    {
        return $this->model->products()->get();
    }

    public function saveProduct(Product $product)
    {
        $this->model->products()->save($product);
    }

    public function dissociateProducts()
    {
        $this->model->products()->each(function (Product $product) {
            $product->brand_id = null;
            $product->save();
        });
    }
}
