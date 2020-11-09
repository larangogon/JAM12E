<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Imagen;
use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Imagen::class, function (Faker $faker) {
    return [
        'name' => $faker->image(public_path('\uploads'), 640, 480, null, false, true),
        'product_id' => Product::all()->random()->id
    ];
});
