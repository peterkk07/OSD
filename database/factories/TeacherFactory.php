
<?php

use OSD\KnowledgeArea;

/*Obtengo las areas de conocimientos para asociarlas al profesor */


$factory->define(OSD\Teacher::class, function (Faker\Generator $faker ,  $areas) {
   
   $KnowledgeAreas = KnowledgeArea::all();

    $areas = array();

    foreach ($KnowledgeAreas as $area) {

        array_push($areas, $area->id);
    }
    return [
    	'knowledge_area_id' => $areas[array_rand($areas)],
        'name' => $faker->name,
        'email'=> $faker->email,
        'password' => $faker->password,
        
    ];
});
