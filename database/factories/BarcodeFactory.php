<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Barcode::class, function (Faker $faker) {
    return [
        'market_id' => 1,
        'barcode' => $faker->randomNumber(),
    ];
});
