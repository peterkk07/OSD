
<?php

$factory->define(OSD\KnowledgeArea::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
