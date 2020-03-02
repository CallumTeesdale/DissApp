<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'id' => 1,
        'id_survey' => 1,
        'response' => '[{"name": "text-1581968386744", "type": "text", "label": "Text Field", "userData": ["test \'"], "className": "form-control"}, {"name": "textarea-1581968387418", "type": "textarea", "label": "Text Area", "userData": ["test \'"], "className": "form-control"}, {"name": "hidden-1581968388128", "type": "hidden", "userData": [""]}, {"name": "select-1581968388862", "type": "select", "label": "Select", "values": [{"label": "Option 1", "value": "option-1", "selected": true}, {"label": "Option 2", "value": "option-2"}, {"label": "Option 3", "value": "option-3"}], "userData": ["option-1"], "className": "form-control"}, {"name": "checkbox-group-1581968391147", "type": "checkbox-group", "label": "Checkbox Group", "values": [{"label": "Option 1", "value": "option-1", "selected": true}], "userData": ["option-1"]}]',
        'user_id' => 2,
    ];
});