
<?php

use OSD\KnowledgeArea;
use OSD\Student;
use OSD\Teacher;


/*Obtengo las areas de conocimientos para asociarlas al estudiante */



$factory->define(Student::class, function (Faker\Generator $faker ,  $areas) {

    $KnowledgeAreas = KnowledgeArea::all();

    $areas = array();

    foreach ($KnowledgeAreas as $area) {

        array_push($areas, $area->id);
    }
   
    return [
    	'knowledge_area_id' => $areas[array_rand($areas)],
        'name' => $faker->name,
        'email'=> $faker->email,
        'ci' => $faker->unique()->randomNumber(7),
        
    ];
});