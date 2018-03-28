
<?php

$factory->define(OSD\User::class, function (Faker\Generator $faker) {
    return [
    	'knowledge_area_id' => factory('OSD\KnowledgeArea')->create()->id,
        'name' => $faker->name,
        'email'=> $faker->email,
        'password' => $faker->password,
        'type' => $faker-> randomElement(['Coordinator','Teacher','Director','admin']),
        ];
});
