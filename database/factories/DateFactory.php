
<?php

$factory->define(OSD\Dates::class, function (Faker\Generator $faker) {

    return [
        'start_date' => $faker->date('Y-m-d', '1461067200'),
        'end_date' => $faker->date('Y-m-d', '1461067200')
    ];
});
