<?php

$factory->define(OSD\SurveyOption::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->randomElement(['1','2','3','4','5']),
        'survey_question_id' => factory('OSD\SurveyQuestion')->create()->id,
    ];
});
