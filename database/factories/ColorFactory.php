<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Color;
use Faker\Generator as Faker;

$factory->define(Color::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName
    ];
});
