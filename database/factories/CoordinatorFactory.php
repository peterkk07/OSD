<?php

$factory->define(OSD\Coordinator::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['pedro','juan','tomas','enrique','salah']),
        'knowledge_area_id' => factory('OSD\KnowledgeArea')->create()->id,
    ];
});
