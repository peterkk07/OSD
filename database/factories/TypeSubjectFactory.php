<?php

$factory->define(OSD\TypeSubject::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        ];
});
