<?php

namespace Modules\Ecommerce\Entities\ProductAttributes;

use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use SoftDeletes;
    protected $table = 'product_attributes';

    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default',
        'product_id'
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

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->select(['id', 'company_id', 'brand_id', 'sku', 'name', 'slug', 'description', 'cover', 'quantity', 'price', 'base_price', 'sale_price', 'special_price', 'tax_id', 'is_visible_on_front', 'is_active', 'created_at']);
    }

    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class)->orderBy('value');
    }
}
