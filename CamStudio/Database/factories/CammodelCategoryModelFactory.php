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


use Illuminate\Http\UploadedFile;
use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;

$factory->define(CammodelCategory::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->randomElement([
        'Latinas',
    ]);

    $file = UploadedFile::fake()->image('cammodel_category.png', 600, 600);

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'banner' => 'Sin Banner',
        'cover' => $file->store('cammodel_categories', ['disk' => 'public']),
        'is_active' => 1
    ];
});
