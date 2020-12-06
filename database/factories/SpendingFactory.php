<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Spending;
use Faker\Generator as Faker;

$factory->define(Spending::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(3),
        'total'       => $faker->numberBetween(10000, 200000),
        'created_by'  => $faker->numberBetween(1, 3),
    ];
});
