<?php

namespace Modules\Ecommerce\Entities\Products\Repositories;

use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductCreateErrorException;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductUpdateErrorException;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\ProductImages\ProductImage;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductNotFoundException;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    use ProductTransformable, UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'sku',
        'name',
        'description',
        'cover',
        'quantity',
        'price',
        'is_active',
        'brand_id',
        'sale_price',
        'slug',
    ];

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->all($this->columns, $order, $sort);
    }

    public function createProduct(array $data): Product
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e);
        }
    }

    public function updateProduct(array $data): bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }

    public function findProductById(int $id): Product
    {
        try {
            return $this->transformProduct($this->model->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function deleteProduct(Product $product): bool
    {
        $product->images()->delete();
        return $product->delete();
    }

    public function removeProduct(): bool
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    public function detachCategories()
    {
        $this->model->categories()->detach();
    }

    public function detachProductGroup()
    {
        $this->model->categories()->detach();
    }

    public function getCategories(): Collection
    {
        return $this->model->categories()->get();
    }

    public function syncCategories(array $params)
    {
        $this->model->categories()->sync($params);
    }

    public function syncProducGroups(array $params)
    {
        $this->model->productGroups()->sync($params);
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->update(['cover' => null], $file['product']);
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('product_images')
            ->where('src', $src)
            ->delete();
    }

    public function findProductBySlug(array $slug): Product
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function searchProduct(string $text): Collection
    {
        if (!empty($text)) {
            return $this->model->searchProduct($text);
        } else {
            return $this->listProducts();
        }
    }

    public function findProductImages(): Collection
    {
        return $this->model->images()->get();
    }

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    public function saveProductImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file);
            $productImage = new ProductImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    public function saveProductAttributes(ProductAttribute $productAttribute): ProductAttribute
    {
        $this->model->attributes()->save($productAttribute);
        return $productAttribute;
    }

    public function listProductAttributes(): Collection
    {
        return $this->model->attributes()->get();
    }

    public function removeProductAttribute(ProductAttribute $productAttribute): ?bool
    {
        return $productAttribute->delete();
    }

    public function saveCombination(ProductAttribute $productAttribute, AttributeValue ...$attributeValues): Collection
    {
        return collect($attributeValues)->each(function (AttributeValue $value) use ($productAttribute) {
            return $productAttribute->attributesValues()->save($value);
        });
    }

    public function listCombinations(): Collection
    {
        return $this->model->attributes()->map(function (ProductAttribute $productAttribute) {
            return $productAttribute->attributesValues;
        });
    }

    public function findProductCombination(ProductAttribute $productAttribute)
    {
        $values = $productAttribute->attributesValues()->get();

        return $values->map(function (AttributeValue $attributeValue) {
            return $attributeValue;
        })->keyBy(function (AttributeValue $item) {
            return strtolower($item->attribute->name);
        })->transform(function (AttributeValue $value) {
            return $value->value;
        });
    }

    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    public function findBrand()
    {
        return $this->model->brand;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail($this->columns);
    }
}