<?php

$factory->define(OSD\Survey::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['encuesta1','encuesta2','encuesta3','encuesta4','encuesta5']),
        'description' => $faker->randomElement(['encuesta periodo 2017-2018','encuesta periodo 2016-2017','encuesta periodo 2018-2019','encuesta periodo 2014-2015','encuesta periodo 2019-2020']),
    ];
});
