<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use OSD\SurveyOption;
class SurveyOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

    	for ($i=1 ; $i<=5; $i++){

    		$surveyOption = SurveyOption::create([

            	'description' => $i
        	]);

    	}

    }
}



