<?php

$factory->define(OSD\Opcion::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->unique()->randomElement(['1','2','3','4','5'])
    ];
});
