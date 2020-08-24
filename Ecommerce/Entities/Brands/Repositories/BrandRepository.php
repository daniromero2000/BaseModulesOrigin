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
use Illuminate\Http\UploadedFile;
use Modules\Generals\Entities\Tools\UploadableTrait;

use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    use UploadableTrait;

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

    public function createBrand(array $params): Brand
    {
        try {

            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['logo']) && ($params['logo'] instanceof UploadedFile)) {
                    $logo = $this->uploadOne($params['logo'], 'brands');
                }

                $merge = $collection->merge(compact('slug', 'logo'));
                $brand = new Brand($merge->all());
                $brand->save();

               return $brand;
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

    public function updateBrand(array $params): bool
    {
        try {
            $brand = $this->findBrandById($this->model->id);
            $collection = collect($params)->except('_token');
            $slug = str_slug($collection->get('name'));

            if (isset($params['logo']) && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'logo'));

            $brand->update($merge->all());
            return 'true';

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
