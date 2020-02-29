<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Market::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomNumber(),
        'barcode' => $faker->randomNumber(),
        'description' => $faker->text,
        'live' => $faker->boolean,
        'image' => $faker->word . '.jpg',
    ];
});