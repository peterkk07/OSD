
<?php

$factory->define(OSD\KnowledgeArea::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['Calculo','diseño','humanidades',"dibujo"]),
    ];
});
