<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'score'          => $faker->numberBetween(1, 5),
        'rateable_type'  => 'App\Entities\Product',
        'rateable_id'    => $faker->numberBetween(1, 8),
        'qualifier_type' => 'App\Entities\User',
        'qualifier_id'   => $faker->numberBetween(1, 8),
    ];
});
