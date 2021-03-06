<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Seeder;

class CategoryProductsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 2)->create()->each(function (Category $category) {
            factory(Product::class, 1)->make()->each(function (Product $product) use ($category) {
                $category->products()->save($product);
            });
        });
    }
}
