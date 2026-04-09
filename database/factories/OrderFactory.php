<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

use App\Constants\Statuses;
use App\Entities\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'total'   => $faker->numberBetween(10000, 200000),
        'status'  => $faker->randomElement([Statuses::APPROVED_IN_STORE, Statuses::PENDING, Statuses::APPROVED, Statuses::REJECTED]),
    ];
});
