<?php

namespace Modules\Ecommerce\Entities\Categories\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\Categories\Exceptions\CategoryInvalidArgumentException;
use Modules\Ecommerce\Entities\Categories\Exceptions\CategoryNotFoundException;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    use UploadableTrait, ProductTransformable;
    protected $model;
    private $columns = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
    ];

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function listCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->orderBy($order, $sort)
            ->get($this->columns)->except($except);
    }

    public function listFrontCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->where('is_active', 1)->orderBy($order, $sort)
            ->get($this->columns)->except($except);
    }

    public function rootCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->whereIsRoot()
            ->orderBy($order, $sort)
            ->get($this->columns)
            ->except($except);
    }

    public function createCategory(array $params): Category
    {
        try {
            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($params['cover'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'cover'));
            $category = new Category($merge->all());

            if (isset($params['parent'])) {
                $parent = $this->findCategoryById($params['parent']);
                $category->parent()->associate($parent);
            }

            $category->save();
            return $category;
        } catch (QueryException $e) {
            throw new CategoryInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCategory(array $params): Category
    {
        $category = $this->findCategoryById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($params['cover'], 'categories');
        }

        $merge = $collection->merge(compact('slug', 'cover'));

        // set parent attribute default value if not set
        $params['parent'] = $params['parent'] ?? 0;

        // If parent category is not set on update
        // just make current category as root
        // else we need to find the parent
        // and associate it as child
        if ((int) $params['parent'] == 0) {
            $category->saveAsRoot();
        } else {
            $parent = $this->findCategoryById($params['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());

        return $category;
    }

    public function findCategoryById(int $id): Category
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e->getMessage());
        }
    }

    public function deleteCategory(): bool
    {
        return $this->model->delete();
    }

    public function associateProduct(Product $product)
    {
        return $this->model->products()->save($product);
    }

    public function findProducts(): Collection
    {
        return $this->model->products;
    }

    public function findProductsOrder()
    {
        return $this->model->productsOrder;
    }

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])->update($data);
        } catch (QueryException $e) {
            throw new CategoryNotFoundException($e);
        }
    }

    public function findProductsFilter($select)
    {
        return $this->model->productsFilter($select);
    }

    public function syncProducts(array $params)
    {
        $this->model->products()->sync($params);
    }

    public function detachProducts()
    {
        $this->model->products()->detach();
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->update(['cover' => null], $file['category']);
    }

    public function findCategoryBySlug(array $slug): Category
    {
        try {
            return $this->model->where('slug', $slug)->first($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException($e);
        }
    }

    public function findParentCategory()
    {
        return $this->model->parent;
    }

    public function findChildren()
    {
        return $this->model->children;
    }

    public function getCategoryProductAttributes($products)
    {
        $productAttributes = new Collection();
        foreach ($products as $productAttribute) {
            foreach ($productAttribute->attributes as $attribute) {
                $productAttributes->push($attribute);
            }
        }

        $attributesValueses = new Collection();
        foreach ($productAttributes as $productAttribute) {
            foreach ($productAttribute->attributesValues as $attributesValues) {

                $attributesValueses->push($attributesValues);
            }
        }

        $values = new Collection;
        foreach ($attributesValueses as $valueses) {
            $values->push($valueses->id);
        }

        return $values->unique()->toArray();
    }
}
