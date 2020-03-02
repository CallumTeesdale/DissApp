<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->userName,
        'email' => $faker->safeEmail,
        'created_at' => $faker->date(),
        'updated_at' => $faker->date(),
    ];
});