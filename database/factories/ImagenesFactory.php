<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Imagen;
use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Imagen::class, function (Faker $faker) {
    return [
        'name' => $faker->image(public_path('/uploads'), 640, 480, null, false),
        'product_id' => Product::all()->random()->id
    ];
});
