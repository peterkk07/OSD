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
use OSD\StudentProgramming;
use OSD\SubjectProgramming;
use Session;
use DB;

class SurveyController extends Controller
{
    
   public function makeSurveyHome($token,$id) {


      $url = url('dashboard/finalizar-encuesta/');

     /* Verificar si la persona ya contesto la encuesta */
      $check = DB::table('survey_activations')->where('token',$token)->first();
      
      if(is_null($check)){

         return view('survey.endSurveyView');

      }


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

      /*en caso de que no hayan profesores disponibles para evaluar*/

      if (count($Teachers) == 0){

         return redirect()->to($url)->with('error',"No tienes profesores disponibles para evaluar");

      }


      return view('survey.homeSurvey',['Teachers' => $Teachers, 'StudentId' => $StudentId, "cod_token" =>$token]);

   }


   public function makeSurvey($token,$id) {

      $StudentId = $id;
      
      $StudentCi= Student::find($id);

      $count_evaluation = $StudentCi->count_evaluation;

      $url = url('dashboard/llenar-encuesta-inicio/' . $token . '/' . $StudentId);

     /* En caso de que el estudiante ya haya evaluado a dos profesores ,no podra seguir evaluando en este proceso*/

      if ($StudentCi->count_evaluation >=2) {

         return redirect()->to($url)->with('error',"Ya has evaluado al límite de profesores para este período lectivo, esperamos tu participación para el siguiente proceso de evaluación");

      }

      $studentSubjects = SubjectProgramming::whereHas('student', function($q) use ($StudentCi) {
            $q->where('ci', $StudentCi->ci);
      })->pluck("subject_id");

      
      $studentTeachers = SubjectProgramming::whereHas('student', function($q) use ($StudentCi) {
               $q->where('ci', $StudentCi->ci);
         })->pluck("teacher_id");

      $StudentProgramming = StudentProgramming::where([
                                          'student_id'=>$StudentId,
                                          'evaluated' =>0
                                          ])->pluck("subject_programming_id");


      $teacherArrayId = array();
      $subject = array();

      foreach ($StudentProgramming as $programmingId) {

         $Id = SubjectProgramming::find($programmingId);

         array_push($teacherArrayId,$Id->teacher_id);

      }


      $teacherFilter = array_unique($teacherArrayId);

      $Teachers = array();
      $Subjects = array();

      foreach ($teacherFilter as $id){

         $t = Teacher::find($id);
         $sp = SubjectProgramming::where('teacher_id',$id)->first();
         $s = Subject::find($sp->subject_id);


         array_push($Teachers,$t);
         array_push($Subjects, $s);
      }


      return view('survey.pickTeacher',['Teachers' => $Teachers, 'StudentId' => $StudentId, "cod_token" =>$token, 'Subjects' => $Subjects, 'count_evaluation' => $count_evaluation]);
   }


   public function startSurvey(Request $request) {

    	$request = $request->all();

    	$cod_token =$request["cod_token"];

    	$SurveyOptions = SurveyOption::all();

      $Scale = array(
        "Completamente en desacuerdo",
        "En desacuerdo",
        "Medianamente de acuerdo",
        "De acuerdo",
        "Completamente de acuerdo"
      );


    	$teacherId = $request["teachers"];

    	$studentId = $request["id_student"];

    	$Survey = SemesterSurvey::where("status",1)->first();

		  $questions = SurveyQuestion::where("survey_id",$Survey->survey_id)->get();

		  $teacher = Teacher::find($teacherId[0]);



      $teacherName = $teacher->name;

      /*$countTeachers = count($teacherNames);*/

    	/*if( (count($request["teachers"])) > 2 )

    	{
    		session()->flash('error', 'Debes elegir un máximo de 2 profesores');
            Session::flash('alert-class', 'alert-danger');

    		return redirect()->back();
    	}*/

 		return view('survey.startSurvey',['teacher_id' => $teacherId[0],'Teachers' => $teacherName,'StudentId' => $studentId, 'Survey_id' => $Survey->survey_id, 'cod_token' => $cod_token])->with(compact('SurveyOptions','questions','Scale'));
    	

    }

   public function  storeSurvey (Request $request) {

      $questions= $request['option'];

    	$survey_id = $request->survey_id;

    	$id_student = $request->id_student;

    	$token = $request->cod_token;

    	$SemesterSurvey = SemesterSurvey::where("status",1)->first();

      $url = url('dashboard/finalizar-encuesta/');

      $url2 = url('dashboard/llenar-encuesta/' . $token . '/' . $id_student);

    	/*$SurveyId = $SemesterSurvey->survey->id;*/

    	$SurveyEvaluationId = SurveyEvaluation::where("semester_survey_id",$SemesterSurvey->id);   

		/*$questions = SurveyQuestion::where("survey_id",$survey_id)->pluck("id");*/

		$countQuestions = count($questions);
		/*cantidad de preguntas totales según el número de profesores*/

		$teacherId = $request["teacher_id"];


		$subjectProgrammingId = SubjectProgramming::whereHas('student', function($q) use ($id_student, $SemesterSurvey) {
            $q->where("student_id", $id_student); 
        })->where([
                  'teacher_id'=> $teacherId,
                  'semester_id' => $SemesterSurvey->semester_id,
                  ])->first();


      $studentProgramming = StudentProgramming::where([
                  'student_id'=> $id_student,
                  'subject_programming_id' => $subjectProgrammingId->id,
                  ])->first();  
     

      $surveyEvaluation = SurveyEvaluation::create([

               'date' =>date("d/m/y"),
               'student_id' => $id_student,
               'semester_survey_id' => $SemesterSurvey->id,
               'student_programming_id' => $studentProgramming->id,

            ]);

      /*Registrar las preguntas de la encuesta para la evaluación de este estudiante*/

      foreach ($questions as $questionId=>$optionId) {

         /*$surveyQuestion = SurveyQuestion::where("survey_id",$question)->first();*/
         $surveyEvaluation->question()->attach(
                                    $questionId,
                                    ['survey_option_id'=> $optionId]);

      }

   /*  Marcar la materia como evaluada*/

      $studentProgramming = StudentProgramming::where([
                  'student_id'=> $id_student,
                  'subject_programming_id' => $subjectProgrammingId->id,
                  ])->update(['evaluated' => 1]);
  
      
      $count_evaluation_student = Student::where('id',$id_student)->first()->count_evaluation;


      $student = Student::where('id',$id_student)->update(['count_evaluation' => $count_evaluation_student+1]);

       $student = Student::where('id',$id_student)->update(['answered' => 1]);



      if($count_evaluation_student+1 <= 1) {

         return redirect()->to($url2)->with('success','Se han guardado tus respuestas exitosamente, si deseas evaluar a otro profesor, selecciona de nuevo a uno de la lista, en caso contrario has click en el botón "Finalizar proceso"');
      }


      if($count_evaluation_student+1 >= 2) {

        /* Deshabilitar enlace a la encuesta, ya que esta fue finalizada*/

         $check = DB::table('survey_activations')->where('token',$token)->first();
         
         if(!is_null($check)){
           
            DB::table('survey_activations')->where('token',$token)->delete();

            return redirect()->to($url)->with('success',"Se han guardado tus respuestas exitosamente");

         }
      }

   }

   public function endSurvey($token,$id) {

      /* Deshabilitar enlace a la encuesta, ya que esta fue finalizada*/

      $check = DB::table('survey_activations')->where('token',$token)->first();
      
      if(!is_null($check)){

         DB::table('survey_activations')->where('token',$token)->delete();

         return view('survey.endSurveyView');

      }
   }

   public function endSurveyView() {

      return view('survey.endSurveyView');
   }


}
