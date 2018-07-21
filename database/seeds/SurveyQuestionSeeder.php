<?php

use Illuminate\Database\Seeder;

use OSD\Survey;
use OSD\Question;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $Survey = Survey::all();

        $countSurvey= count($Survey);
       
        $Question = Question::all();

        $countQuestion= count($Question);


        /* asociar la pregunta a cada encuesta*/ 

        for ($i=0; $i< $countSurvey; $i++) {

                for ($j=0; $j< $countQuestion; $j++) {

                $Survey[$i]->question()->attach(
                                    $Question[$j]->id,
                                    ['description'=>$Question[$j]->description]);
            }
            
        }

    }
}