<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;

use OSD\Http\Requests;
use OSD\Semester;
use OSD\Survey;
use OSD\Teacher;
use OSD\Subject;
use OSD\SubjectType;
use OSD\KnowledgeArea;
use OSD\SurveyOption;
use OSD\SurveyQuestion;
use OSD\SurveyEvaluation;
use OSD\SemesterSurvey;
use OSD\Student;
use OSD\SubjectProgramming;
use Session;

class SurveyController extends Controller
{
    


    public function makeSurvey($token,$id) {


    	$StudentId = $id;

    	$StudentCi= Student::find($id)->first();

         
        $studentTeachers = SubjectProgramming::whereHas('student', function($q) use ($StudentCi) {
            $q->where('ci', $StudentCi->ci);
        })->pluck("teacher_id");

      
      	$studentSubjects = SubjectProgramming::whereHas('student', function($q) use ($StudentCi) {
            $q->where('ci', $StudentCi->ci);
        })->pluck("subject_id");


      	$Teachers = array();
      	$Subjects = array();

      	$countTeacher = count($studentTeachers);

      	for ($i=0; $i<$countTeacher; $i++ ){

      		$t = Teacher::find($studentTeachers[$i]);
      		
      		array_push($Teachers,$t);
      	}


        return view('survey.pickTeacher',['Teachers' => $Teachers, 'StudentId' => $StudentId, "cod_token" =>$token]);

    }


    public function startSurvey(Request $request) {

    	$request = $request->all();

    	$cod_token =$request["cod_token"];

    	$SurveyOptions = SurveyOption::all();

    	$teachers = $request["teachers"];

    	$countTeacher = count($request["teachers"]);


    	$studentId = $request["id_student"];

    	$Survey = SemesterSurvey::where("status",1)->first();

		$questions = SurveyQuestion::where("survey_id",$Survey->survey_id)->get();

		$teacherNames = array();

    	for ($i=0; $i<$countTeacher; $i++ ){

      		$t = Teacher::find($teachers[$i]);
      		
      		array_push($teacherNames,$t->name);
      	}

      	$countTeachers = count($teacherNames);

    	if( (count($request["teachers"])) > 2 )

    	{
    		session()->flash('error', 'Debes elegir un máximo de 2 profesores');
            Session::flash('alert-class', 'alert-danger');

    		return redirect()->back();
    	}

 		return view('survey.startSurvey',['Teachers' => $teacherNames, 'CountTeachers'=> $countTeacher , 'StudentId' => $studentId, 'Survey_id' => $Survey->survey_id, 'cod_token' => $cod_token])->with(compact('SurveyOptions','questions'));
    	

    }

    public function  storeSurvey (Request $request) {

    	
    	$survey_id = $request->survey_id;

    	$id_student = $request->id_student;

    	$cod_token = $request->cod_token;

    	$SemesterSurvey = SemesterSurvey::where("status",1)->first();

    	$SemesterId = $SemesterSurvey->survey->id;

    	$SurveyEvaluationId = SurveyEvaluation::where("semester_survey_id",$SemesterSurvey->id);   

		$questions = SurveyQuestion::where("survey_id",$survey_id)->pluck("id");

		$countTeachers = $request->count_teacher;

		$countQuestions = count($questions);
		/*cantidad de preguntas totales según el número de profesores*/

		$teacherNames = $request["teacher"];

		$teacherIds = array();

		for ($i=0 ; $i< count($teacherNames); $i++){

			$t = Teacher::where("name",$teacherNames[$i])->first();

			array_push($teacherIds, $t->id);
		}

		$t = $teacherIds[0];


		$subjectProgrammingId = SubjectProgramming::whereHas('student', function($q) use ($id_student) {
            $q->where("student_id", $id_student); 
        })->where("id_teacher")get();


		var_dump(count($subjectProgrammingId));
		return "teacher";

		
			var_dump($request["option0"][172]);

			return "questions";


    	return "request";


    }


    


}
