<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->name,
        'image' => $faker->word,

    ];
});