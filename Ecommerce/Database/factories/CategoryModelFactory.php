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


use Modules\Ecommerce\Entities\Categories\Category;
use Illuminate\Http\UploadedFile;

$factory->define(Category::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->randomElement([
        'Gear',
        'Ropa',
        'Zapatos',
        'Diapering',
        'Feeding',
        'Bath',
        'Juguetes',
    ]);

    $file = UploadedFile::fake()->image('category.png', 600, 600);

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'cover' => $file->store('categories', ['disk' => 'public']),
        'is_active' => 1
    ];
});
