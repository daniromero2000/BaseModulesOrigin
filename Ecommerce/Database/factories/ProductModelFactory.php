<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Http\UploadedFile;

$factory->define(Product::class, function (Faker\Generator $faker) {
    $product = $faker->unique()->sentence;
    $file = UploadedFile::fake()->image('product.png', 600, 600);

    return [
        'sku' => $this->faker->numberBetween(1111111, 999999),
        'name' => $product,
        'company_id' => 1,
        'brand_id' => 1,
        'slug' => str_slug($product),
        'description' => $this->faker->paragraph,
        'cover' => $file->store('products', ['disk' => 'public']),
        'quantity' => 10,
        'price' => 20000.00,
        'is_active' => 1,
        'weight' => 5,
        'mass_unit' => config('shop.weight', 'gms'),
        'tax_id' => 1,
    ];
});
