<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SurveyOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OSD\SurveyOption::class, 5)->create();
    }
}



