<?php

namespace Modules\Ecommerce\Entities\Brands;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
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

    public function products()
    {
        return $this->hasMany(Product::class)
            ->select(['id', 'company_id', 'brand_id', 'sku', 'name', 'slug', 'description', 'cover', 'quantity', 'price', 'base_price', 'sale_price', 'special_price', 'tax_id', 'is_visible_on_front', 'is_active', 'created_at']);
    }
}
