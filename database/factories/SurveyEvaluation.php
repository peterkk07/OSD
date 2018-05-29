<?php

$factory->define(OSD\SurveyEvaluation::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->randomElement(['encuesta periodo 2017-2018','encuesta periodo 2016-2017','encuesta periodo 2018-2019','encuesta periodo 2014-2015','encuesta periodo 2019-2020']),

       'student_id' => factory('OSD\Student')->create()->id,
       'semester_survey_id' => factory('OSD\SemesterSurvey')->create()->id,
       'student_programming_id' => factory('OSD\StudentProgramming')->create()->id,
    ];
});
