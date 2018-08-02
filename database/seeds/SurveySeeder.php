<?php

use Illuminate\Database\Seeder;
use OSD\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $survey = Survey::create([
            'name' => "Encuesta piloto",
        ]);
        
    }
}
