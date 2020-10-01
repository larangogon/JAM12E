<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Size;
use Faker\Generator as Faker;

$factory->define(Size::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['XS', 'S', 'M', 'L', 'XL'])
    ];
});