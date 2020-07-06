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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Customers\Entities\CustomerPhones\CustomerPhone;
use Modules\Customers\Entities\Customers\Customer;

$factory->define(CustomerPhone::class, function (Faker\Generator $faker) {

    $customer = factory(Customer::class)->create();

    return [
        'phone_type'   => 'Fijo',
        'phone'   => '0',
        'customer_id' => $customer->id,
        'status'      => 1
    ];
});
