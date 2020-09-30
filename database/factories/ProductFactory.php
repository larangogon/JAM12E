<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->sentence(10),
        'stock' => $faker->numberBetween(1, 100),
        'price' => $faker->numberBetween(10000,200000),
        'active' => 1
    ];
});
