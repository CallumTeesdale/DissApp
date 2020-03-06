<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Survey::class, function (Faker $faker) {
  return [
    'id' => 1,
    'form_data' =>
      '"[\n  {\n    \"type\": \"header\",\n    \"label\": \"Q1. How often do you game\"\n  },\n  {\n    \"type\": \"paragraph\",\n    \"label\": \"Select from the options\"\n  },\n  {\n    \"type\": \"radio-group\",\n    \"required\": true,\n    \"label\": \"Hours a day\",\n    \"name\": \"radio-group-1583093906244\",\n    \"values\": [\n      {\n        \"label\": \"1 to 3\",\n        \"value\": \"1-to-3\"\n      },\n      {\n        \"label\": \"4 to 7\",\n        \"value\": \"4-7\"\n      },\n      {\n        \"label\": \"more\",\n        \"value\": \"more\"\n      }\n    ]\n  },\n  {\n    \"type\": \"checkbox-group\",\n    \"required\": true,\n    \"label\": \"Do you own any of these consoles?\",\n    \"name\": \"checkbox-group-1583093960951\",\n    \"values\": [\n      {\n        \"label\": \"Nintendo Switch\",\n        \"value\": \"Nintendo-Switch\",\n        \"selected\": true\n      },\n      {\n        \"label\": \"Playstation\",\n        \"value\": \"Playstation\"\n      },\n      {\n        \"label\": \"Xbox\",\n        \"value\": \"Xbox\"\n      }\n    ]\n  }\n]"',
    'user_id' => $faker->randomNumber(),
    'category' => $faker->randomNumber(),
    'survey_title' => $faker->word,
    'survey_description' => $faker->word,
    'created_at' => $faker->date(),
    'updated_at' => $faker->date(),
    'category' => 1
  ];
});
