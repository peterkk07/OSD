
<?php

$factory->define(OSD\Teacher::class, function (Faker\Generator $faker) {
    return [
    	'knowledge_area_id' => factory('OSD\KnowledgeArea')->create()->id,
        'name' => $faker->name,
        'email'=> $faker->email,
        'password' => $faker->password,
        
        ];
});
