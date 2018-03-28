
<?php

$factory->define(OSD\Subject::class, function (Faker\Generator $faker) {
    return [
    	'knowledge_area_id' => factory('OSD\KnowledgeArea')->create()->id,
    	'type_subject_id' => factory('OSD\TypeSubject')->create()->id,
       	'subject_programming_id' => factory('OSD\SubjectProgramming')->create()->id,
        'name' => $faker->name,
        'code'=>  $faker-> randomElement(['001','002','003','004']),
        'semester'=>  $faker-> randomElement(['1°','2°','3°','4°','5°','6°','7°','8°','9°','10°']),
        ];
});
