<?php

$factory->define(OSD\StudentProgramming::class, function (Faker\Generator $faker) {
    return [
        'student_id' => factory('OSD\Student')->create()->id,
        'subject_programming_id' => factory('OSD\SubjectProgramming')->create()->id,
    ];
});
