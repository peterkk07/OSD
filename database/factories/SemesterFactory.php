<?php

$factory->define(OSD\Semester::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['1°','2°','3°','4°','5°']),
    ];
});
