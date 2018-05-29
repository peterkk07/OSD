<?php

$factory->define(OSD\SubjectType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        ];
});
