<?php

use Illuminate\Database\Seeder;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OSD\SurveyQuestion::class, 100)->create();
    }
}
