<?php

$factory->define(OSD\SemesterSurvey::class, function (Faker\Generator $faker) {
    return [
        'semester_id' => factory('OSD\Semester')->create()->id,
        'survey_id' => factory('OSD\Survey')->create()->id,
    ];
});
