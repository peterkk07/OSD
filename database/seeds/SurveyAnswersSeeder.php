<?php

use Illuminate\Database\Seeder;

class SurveyAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OSD\SurveyAnswer::class, 1)->create();
    }
}
