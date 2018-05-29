
<?php

$factory->define(OSD\SubjectProgramming::class, function (Faker\Generator $faker) {
    return [
    	'subject_id' => factory('OSD\Subject')->create()->id,
    	'semester_id' => factory('OSD\Semester')->create()->id,
       	'section_id' => factory('OSD\Section')->create()->id,
        'teacher_id' => factory('OSD\Teacher')->create()->id,
        'coordinator_id'=> factory('OSD\Coordinator')->create()->id,
        ];
});
