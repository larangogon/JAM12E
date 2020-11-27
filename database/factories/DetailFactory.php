<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Detail;
use Faker\Generator as Faker;

$factory->define(Detail::class, function (Faker $faker) {
    return [
        'total'  => $faker->numberBetween(1, 1000985433),
        'stock' =>  $faker->numberBetween(1, 15),
        'color_id' => $faker->numberBetween(1, 100),
        'category_id' => $faker->numberBetween(1, 3),
        'size_id' => $faker->numberBetween(1, 5),
        'product_id' => $faker->numberBetween(1, 5),
        'order_id' => $faker->numberBetween(1, 100),
    ];
});
