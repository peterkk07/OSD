<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;

use OSD\Http\Requests;
use OSD\Respuesta;
use OSD\Pregunta;
use OSD\Opcion;
use DB;
use \Datetime;
use OSD\KnowledgeArea;
use OSD\Subject;
use OSD\Semester;
use OSD\Section;
use OSD\Teacher;
use OSD\Coordinator;
use OSD\SubjectProgramming;
use OSD\Dates;
use OSD\SurveyEvaluation;
use OSD\SurveyQuestion;

class testController extends Controller
{
    
	public function index() {


	

		$rol=1;

		$surveyEvaluation = SurveyEvaluation::whereHas('question', function($q) use ($rol) {
            $q->where('survey_id', 1);
        })->first();

		foreach ($surveyEvaluation->question as $survey) {

			var_dump($survey->pivot->id);
			
		}
       /* var_dump($surveyEvaluation);*/

        return "survey";




       /* $question = SurveyQuestion::where("survey_id","2")->pluck("id");

        foreach ($question as $q){

        	var_dump($question[0]);
      
        var_dump($question);

        	return "test";*/
       /* var_dump($question);

        return "aca";
*/
       /* $surveyEvaluation = SurveyEvaluation::find(1);*/


	/*	foreach($surveyEvaluation->question as $survey) {

		 	var_dump($survey->pivot->survey_question_id);
		 }

		return "test";*/


		$preguntas =Pregunta::orderBy('id')->get();
		$opciones=Opcion::orderBy('id')->get();

		return view('test')->with(compact('preguntas'))->with(compact('opciones'));


	}

	public function selected(Request $request )  {


		$opcion = $request['opcion'];
		$pregunta_id = $request['pregunta'];

		$opciones= Opcion::where("description",$opcion)->pluck("description");

		$preguntas = Pregunta::whereHas('opcion', function ($query) use ($opcion) {
        $query->where('description',"=",$opcion);
	    })->where("id",$pregunta_id)->pluck("description");

		$numero_respuestas = count($preguntas);
	
		 return view ('test-count',['cantidad' => $numero_respuestas])->with(compact('opciones'));;

	}

}
