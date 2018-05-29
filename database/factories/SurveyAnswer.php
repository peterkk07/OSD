<?php

$factory->define(OSD\SurveyAnswer::class, function (Faker\Generator $faker) {
    return [
       'survey_option_id' => factory('OSD\SurveyOption')->create()->id,
       'survey_question_id' => factory('OSD\SurveyQuestion')->create()->id,
       'survey_evaluation_id' => factory('OSD\SurveyEvaluation')->create()->id,
       
    ];
});
