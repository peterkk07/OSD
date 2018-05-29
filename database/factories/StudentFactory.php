<?php

$factory->define(OSD\Student::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['pedro','juan','martin','alonso','maria']),
        'knowledge_area_id' => factory('OSD\KnowledgeArea')->create()->id,
        'ci' => $faker->unique()->randomDigit,
    ];
});
