<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'id' => 1,
        'username' => $faker->userName,
        'password' => bcrypt($faker->password),
        'email' => $faker->safeEmail,
        'dob' => $faker->date(),
        'public_key' => $faker->word,
        'priv_level' => $faker->randomNumber(),
        'about' => $faker->word,
        'course' => $faker->word,
        'email_verified_at' => $faker->dateTime(),
        'remember_token' => Str::random(10),
    ];
});