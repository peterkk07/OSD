<?php

use Illuminate\Database\Seeder;
use OSD\SurveyEvaluation;
use OSD\SurveyOption;
use OSD\SurveyQuestion;
use OSD\Survey;

class SurveyAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $SurveyEvaluation = SurveyEvaluation::all();

        $CountEvaluation= count($SurveyEvaluation);
       
		$SurveyOption = SurveyOption::all();

		$CountOption = count($SurveyOption);

		$SurveyQuestion = SurveyQuestion::all();

		$CountQuestion = count($SurveyQuestion);

        $Survey = Survey::where("name", "Encuesta piloto")->first();


		/* asociar la evaluacion-encuesta  a cada  pregunta_encuesta*/ 

		for ($i=0; $i<$CountEvaluation; $i++) {

            $surveyQuestion = SurveyQuestion::where("survey_id",$Survey->id)->pluck('id');
               
                for ($j=0; $j<19; $j++) {

                $SurveyEvaluation[$i]->question()->attach(
                                    $surveyQuestion[$j],
                                    ['survey_option_id'=> rand(1, 5)]);
            }
        }
    }
}
