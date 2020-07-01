<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Seeder;
use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;

class ProductsProductGroupsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Product::class, 2)->create()->each(function (Product $product) {
            factory(ProductGroup::class, 6)->make()->each(function (Product $ProductGroup) use ($product) {
                $product->productGroups()->save($ProductGroup);

                dd($product);
            });
        });
    }
}
