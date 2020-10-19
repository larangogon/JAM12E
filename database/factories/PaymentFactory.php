<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'internalReference' => '1494590937',
        'status'            => 'APPROVED',
        "message"           => 'estos datos son generados como faker',
        'amount'            => $faker->numberBetween(10000, 200000),
        'document'          => $faker->numberBetween(10000, 200000),
        'name'              => $faker->name,
        'email'             => $faker->safeEmail,
        'mobile'            => $faker->phoneNumber,
        'locale'            => 'es_CO',
    ];
});
