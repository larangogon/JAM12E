<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Category;
use Faker\Generator as Faker;

$factory->define(category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Hombre', 'Mujer', 'Hogar', 'Niño', 'Accesorios', 'Zapatos'])
    ];
});
