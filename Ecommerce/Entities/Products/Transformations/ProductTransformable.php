<?php

namespace Modules\Ecommerce\Entities\Products\Transformations;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Support\Facades\Storage;

trait ProductTransformable
{
    /**
     * Transform the product
     *
     * @param Product $product
     * @return Product
     */
    protected function transformProduct(Product $product)
    {
        $prod = new Product;
        $prod->id = (int) $product->id;
        $prod->name = $product->name;
        $prod->sku = $product->sku;
        $prod->slug = $product->slug;
        $prod->description = $product->description;
        $prod->cover = asset("storage/$product->cover");
        $prod->quantity = $product->quantity;
        $prod->price = $product->price;
        $prod->is_active = $product->is_active;
        $prod->weight = (float) $product->weight;
        $prod->mass_unit = $product->mass_unit;
        $prod->sale_price = $product->sale_price;
        $prod->brand_id = (int) $product->brand_id;

        return $prod;
    }
}