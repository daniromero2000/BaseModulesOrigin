<?php

namespace Modules\Ecommerce\Entities\Products;

use Illuminate\Database\Eloquent\Builder;
use Modules\Ecommerce\Entities\Brands\Brand;
use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\ProductImages\ProductImage;
use Modules\Ecommerce\Entities\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Ecommerce\Entities\ProductReviews\ProductReview;

class Product extends Model implements Buyable
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'products';

    public const MASS_UNIT = [
        'ONZAS' => 'oz',
        'GRAMOS' => 'gms',
        'LIBRAS' => 'lbs'
    ];

    public const DISTANCE_UNIT = [
        'CENTIMETROS' => 'cm',
        'METROS' => 'mtr',
        'PULGADAS' => 'in',
        'MILIMETROS' => 'mm',
        'PIES' => 'ft',
        'YARDAS' => 'yd'
    ];

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.sku' => 10,
            'products.description' => 5
        ]
    ];

    protected $fillable = [
        'id',
        'sku',
        'name',
        'description',
        'cover',
        'quantity',
        'price',
        'brand_id',
        'weight',
        'mass_unit',
        'is_active',
        'sale_price',
        'length',
        'width',
        'height',
        'distance_unit',
        'slug',
        'company_id',
        'brand_id',
        'sort_order',
        'tax_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function productGroups()
    {
        return $this->belongsToMany(ProductGroup::class);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @param null $options
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @param null $options
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @param null $options
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)
            ->select(['id', 'product_id', 'src']);
    }

    public function searchProduct(string $term): Collection
    {
        return self::search($term)->get();
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class)
            ->with('attributesValues')
            ->select(['id', 'quantity', 'price', 'sale_price', 'default', 'product_id']);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)
            ->select(['id', 'name', 'slug', 'logo', 'is_visible_on_front', 'is_active']);
    }
    /**
     * Get the product reviews.
     *
     * @param 
     * @return 
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
