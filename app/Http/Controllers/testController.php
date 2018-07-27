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
use OSD\SurveyAnswer;
use OSD\Student;

class testController extends Controller
{
    
	public function index() {

		/*$preguntas =Pregunta::orderBy('id')->get();
		$opciones=Opcion::orderBy('id')->get();
*/
	/*	return view('test')->with(compact('preguntas'))->with(compact('opciones'));*/

	$teacher = 1;

	$students = Student::whereHas('subject_programming', function($q) use ($teacher) {
            $q->where('teacher_id',$teacher);
        })->pluck("id");

	var_dump($students);

	return "students";


	}

	public function showTeacher() {

		$teachers = Teacher::all();

        return view('test.showTeachers')->with(compact('teachers'));

	}


	public function pickTeacher(Request $request) {

	
		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$TeacherName = Teacher::where("id",$request->teacher)->pluck("name");

		$teacher = $request->teacher;

		$students = Student::whereHas('subject_programming', function($q) use ($teacher) {
            $q->where('teacher_id', $teacher);
        })->pluck("id");

		$count=count($students);

		/*id de las evaluaciones de encuesta del estudiante seleccionado*/

		$option1 = 0; 
		$option2 = 0;
		$option3 = 0;
		$option4 = 0;
		$option5 = 0;


		for ($i=0 ; $i< $count; $i++) {

			$SurveyEvaluationIds = SurveyEvaluation::where("student_id",$students[$i])->pluck("id");

			$count_evaluation = count ($SurveyEvaluationIds);

			for ($j=0 ; $j< $count_evaluation ; $j++) {

				$SurveyEvaluation = SurveyEvaluation::find($SurveyEvaluationIds[$j]);

				foreach ($SurveyEvaluation->option as $option) {

					switch ($option->description) {
						case '1':
							$option1++;
							break;
						
						case '2':
							$option2++;
							break;

						case '3':
							$option3++;
							break;
							
						case '4':
							$option4++;
							break;
							
						case '5':
							$option5++;
							break;
							

						default:
							
							break;
					}
				}
			}

		}

		return view('test.viewOption',[
					'options' => [$option1, $option2, $option3, $option4, $option5],
					'TeacherName' =>$TeacherName]);
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
