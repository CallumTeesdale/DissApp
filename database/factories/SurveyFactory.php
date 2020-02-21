<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Survey::class, function (Faker $faker) {
    return [
        'id' => 9,
        'form_data' => '[{"type": "header", "label": "Header"}]',
        'creator_id' => $faker->randomNumber(),
        'category' => $faker->randomNumber(),
        'survey_title' => $faker->word,
        'survey_description' => $faker->word,
    ];
});