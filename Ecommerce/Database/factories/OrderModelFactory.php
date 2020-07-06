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


use Modules\Generals\Entities\Cities\City;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;

$factory->define(Order::class, function (Faker\Generator $faker) {

    $courier = factory(Courier::class)->create();
    $customer = factory(Customer::class)->create();

    $city = factory(City::class)->create();
    $address = factory(CustomerAddress::class)->create([
        'country_id' => 1,
        'city' => $city->name,
        'customer_id' => $customer->id
    ]);

    $os = factory(OrderStatus::class)->create();

    return [
        'reference' => $faker->uuid,
        'courier_id' => $courier->id,
        'customer_id' => $customer->id,
        'address_id' => $address->id,
        'order_status_id' => $os->id,
        'payment' => 'paypal',
        'discounts' => $faker->randomFloat(2, 10, 999),
        'sub_total' => $faker->randomFloat(2, 10, 5555),
        'tax_amount' => $faker->randomFloat(2, 10, 9999),
        'grand_total' => $faker->randomFloat(2, 10, 9999),
        'total_paid' => $faker->randomFloat(2, 10, 9999),
        'invoice' => null,
    ];
});
