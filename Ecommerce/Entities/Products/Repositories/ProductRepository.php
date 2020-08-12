<?php

namespace Modules\Ecommerce\Entities\Products\Repositories;

use Illuminate\Database\Eloquent\Builder;
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
use Faker\Generator as Faker;

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
        'company_id',
        'tax_id'
    ];

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function listProducts(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
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

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])->update($data);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }

    public function findProductById(int $id): Product
    {
        try {
            $data = $this->model->findOrFail($id);
            return $this->transformProduct($this->model->findOrFail($id, $this->columns));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function findProductByIdFull(int $id): Product
    {
        try {
            return $this->model->with(['attributes'])->findOrFail($id);
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
        $this->model->productGroups()->detach();
    }

    public function getCategories(): Collection
    {
        return $this->model->categories()->get();
    }

    public function syncCategories(array $params)
    {
        try {
            $this->model->categories()->sync($params);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function syncProducGroups(array $params)
    {
        try {
            $this->model->productGroups()->sync($params);
        } catch (QueryException $e) {
            dd($e);
        }
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
            return $this->listProducts(0);
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
            $filename = $this->storeFile($file, 'products');
            $productImage = new ProductImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    public function saveAttributeProductImages(Collection $collection, $productAttributeId)
    {
        $collection->each(function (UploadedFile $file) use ($productAttributeId) {
            $filename = $this->storeFile($file, 'products');
            $productImage = new ProductImage([
                'product_attribute_id' => $productAttributeId,
                'src' => $filename
            ]);
            $productImage->save();
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

    public function listProductGroups($group): Collection
    {
        return $this->model->whereHas('productGroups', function (Builder $query) use ($group) {
            $query->where('name', $group);
        })->get($this->columns);;
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

    public function duplicateProduct(Int $id)
    {
        $product = $this->findProductByIdFull($id);
        $newProduct = $product->replicate();
        $newProduct->sku = rand(0, 10000000);
        $newProduct->push();

        //re-sync everything
        foreach ($newProduct->attributes as $attributes => $values) {
            try {
                $newProduct->attributes()->save($values);
            } catch (QueryException $th) {
                dd($th);
            }
        }

        return $newProduct;
    }
}