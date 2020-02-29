<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Market::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => 'faker',
        'price' => 3,
        'barcode' => 1234567,
        'description' => 'description',
        'live' => 1,
        'image' => 'item.jpg'
    ];
});