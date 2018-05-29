<?php

$factory->define(OSD\Section::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->randomElement(['U1','F1','E1','C1','M1'])
        ];
});
