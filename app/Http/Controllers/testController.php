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
use OSD\SubKnowledgeArea;
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
use OSD\SemesterSurvey;
use OSD\SurveyOption;

class testController extends Controller
{
    
	public function index() {


$string = "hola";

var_dump(str_replace('"', ".", $string ));

return "string";


	
/* ****************************************/

		$TeacherId = 1;

		$SubjectId = 1;
		
		$SemesterId = 1;

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$SurveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId);

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;


		$studentsIds = Student::whereHas('subject_programming', function($q) use ($TeacherId,$SemesterId,$SubjectId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $SemesterId,
		    'subject_id' => $SubjectId
		
		]);})->pluck("id");



		$subjectsProgrammingsIds = SubjectProgramming::where([
													    'student_id' =>  $data->pivot->student_id,
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $data->pivot->id
													])->first()->id;
		$count=count($studentsIds);



		/*id de las evaluaciones de encuesta del estudiante seleccionado*/

		$option1 = 0; 
		$option2 = 0;
		$option3 = 0;
		$option4 = 0;
		$option5 = 0;

		$surveyEvaluationsIds = array();

		foreach ($studentsIds as $studentId) {

			$student = Student::find($studentId);

			foreach ($student->subject_programming as $data) {

				$SurveyEvaluationId = SurveyEvaluation::where([
													    'student_id' =>  $data->pivot->student_id,
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $data->pivot->id
													])->first()->id;
				
				array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
			}

		}

		var_dump($surveyEvaluationsIds);

		return "surveys";

 
 	/*opciones asociadas a las preguntas */

 	$option1Id = SurveyOption::where("description","1")->first()->id;
 	$option2Id = SurveyOption::where("description","2")->first()->id;
 	$option3Id = SurveyOption::where("description","3")->first()->id;
 	$option4Id = SurveyOption::where("description","4")->first()->id;
 	$option5Id = SurveyOption::where("description","5")->first()->id;

		foreach ($surveyEvaluationsIds as $data){

			$SurveyEvaluation = SurveyEvaluation::find($data);

			$SurveyAnswer = SurveyAnswer::where([
											    'survey_option_id' =>  $data->pivot->student_id,
											    'semester_survey_id' => $semesterSurveyId,
											    'student_programming_id' => $data->pivot->id
											])->first()->id;
			
		}

		return "datas";

		


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
		



		var_dump(['options' => [$option1, $option2, $option3, $option4, $option5]]);

		return "aca";









/* **************************************************/

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$TeacherId = 1;

		$SubjectId = 1;
		
		$Semester = 1;

		$studentsIds = Student::whereHas('subject_programming', function($q) use ($TeacherId,$Semester,$SubjectId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $Semester,
		    'subject_id' => $SubjectId
		
		]);})->pluck("id");


		$count=count($studentsIds);

		/*id de las evaluaciones de encuesta del estudiante seleccionado*/

		$option1 = 0; 
		$option2 = 0;
		$option3 = 0;
		$option4 = 0;
		$option5 = 0;


		for ($i=0 ; $i< $count; $i++) {

			$SurveyEvaluationIds = SurveyEvaluation::where("student_id",$studentsIds[$i])->pluck("id");
			
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

		var_dump(['options' => [$option1, $option2, $option3, $option4, $option5]]);

		return "options";



/*---------------------------------------------------------------------------- */
		$teacher = 2;

		$semester = 1;

		$SubjectId = 2;


		$studentsIds = Student::whereHas('subject_programming', function($q) use ($teacher,$semester,$SubjectId) {
        
        $q->where([
		    'teacher_id' =>  $teacher,
		    'semester_id' => $semester,
		    'subject_id' => $SubjectId
		
		]);})->pluck("id");


	
		var_dump($studentsIds);
		return "estudiantes";

		$subjectName = Subject::find(100);

		var_dump($subjectName->name);

		return "nombres";


		$TeacherId = 1;

		$TeachersIds = array();

		$SubjectIds = array();

		$SubjectNames = array();

		$knowledgeAreaIds = array();

		$knowledgeAreaNames = array();

		$subKnowledgeAreaIds = array();

		$subKnowledgeAreaNames = array();


		$SubjectObject =  SubjectProgramming::where("teacher_id",$TeacherId)->get();


		foreach ($SubjectObject as $data) {

			array_push($TeachersIds,$data["teacher_id"]);
			array_push($SubjectIds,$data["subject_id"]);
		}


		foreach($SubjectIds as $data) {

			$subjectName = Subject::find($data);
			
			array_push($SubjectNames,$subjectName->name);

			array_push($knowledgeAreaIds,$subjectName->knowledge_area["id"]);

			array_push($knowledgeAreaNames,$subjectName->knowledge_area["name"]);

			array_push($subKnowledgeAreaIds,$subjectName->sub_knowledge_area["id"]);

			array_push($subKnowledgeAreaNames,$subjectName->sub_knowledge_area["name"]);

		}

	


		/* Funcion para filtrar valores nulos*/
               	$c = function($v){
				   
				    return array_filter($v) != array();
				};

			   /*Datos filtrados, quitando valores NULL*/

			

			    $SemesterFilter = array_filter($subKnowledgeAreaIds, $c);


			   /* var_dump($SemesterFilter);*/

return "aca";
		/* ***********/


		$subjectName = Subject::find(100);

		
		var_dump($subjectName->name);

		return "aca";


		$TeacherId = 5;

		$TeachersIds = array();

		$SubjectIds = array();

		$SubjectNames= array();

		$knowledgeAreaIds = array();

		$knowledgeAreaNames = array();

		$subKnowledgeAreaIds = array();

		$subKnowledgeAreaNames = array();


		$SubjectObject =  SubjectProgramming::where("teacher_id",$TeacherId)->get();

		foreach ($SubjectObject as $data) {

			array_push($TeachersIds,$data["teacher_id"]);
			array_push($SubjectIds,$data["subject_id"]);
		}


		foreach($SubjectIds as $data) {

			var_dump($data);

			$subjectName = Subject::find($data);

			array_push($knowledgeAreaIds,$subjectName->knowledge_area["id"]);

			array_push($knowledgeAreaNames,$subjectName->knowledge_area["name"]);

			array_push($subKnowledgeAreaIds,$subjectName->sub_knowledge_area["id"]);

			array_push($subKnowledgeAreaNames,$subjectName->sub_knowledge_area["name"]);

		}

			var_dump($knowledgeAreaIds);

			var_dump($knowledgeAreaNames);

			var_dump($subKnowledgeAreaIds);

			var_dump($subKnowledgeAreaNames);


		return "aca";


/* *****************************************************/
	$Subject = Subject::find(18);

		$knowledgeAreaId = $Subject->knowledge_area["id"];

		$knowledgeAreaName = $Subject->knowledge_area["name"];

		$subknowledgeAreaId = $Subject->sub_knowledge_area["id"];
		
		$subknowledgeAreaName = $Subject->sub_knowledge_area["name"];
		
		
		$subjectId = 3;

		$teachers = array();

		$teacherObject = Teacher::whereHas('subject',  function($query) use ($subjectId) {
                
            $query->where('subject_id', '=', $subjectId );
               
                })->get();


		foreach ($teacherObject as $data){

			array_push($teachers,$data["name"]);

		}

		var_dump($teachers);

		return "ds";

		$knowledgeAreaId = KnowledgeArea::where("name",$knowledgeArea)->first();

		$Id = (!isset($knowledgeAreaId ) || is_null($knowledgeAreaId )) ? 'hello' : $knowledgeAreaId->id ; 


		
		return "var";
		if($subKnowledgeAreaId == NULL){

			var_dump("es nulo");
		}

		return "no es nulo";
		$subKnowledgeAreasIds = array();
		
		foreach ($Subject->knowledge_area as $data){

			/*$Id = $data["name"];*/

			var_dump($data["id"]);
			

			
		}

return "know";


/* *****************************************************************************/
		$SubKnowledgeArea = SubKnowledgeArea::find(3);

		/*Ids de materias */ 

		$subjectsIds = array();

		foreach ($SubKnowledgeArea->subject as $data){

			array_push($subjectsIds,$data["id"]);
		}

		var_dump($subjectsIds);
		return "sub";



		$KnowledgeArea = KnowledgeArea::find(3);

		$SubKnowledgeAreaNames = array();

		foreach ($KnowledgeArea->subKnowledgeArea as $data)
			  array_push($SubKnowledgeAreaNames,$data["name"]);
		

		$SubjectsIds = array();

		foreach ($KnowledgeArea->subject as $data){

			array_push($SubjectsIds,$data["id"]);

		}
		
		$subjectNames = array();

		foreach ($SubjectsIds as $Ids) {

			$subject = Subject::find($Ids);
			array_push($subjectNames,$subject->name);

		}	

		return "ids";

		$teachers = array();


		foreach ($KnowledgeArea->subject as $data){

			$subjectId = $data["id"];

			$teacherObject = Teacher::whereHas('subject',  function($query) use ($subjectId) {
                
                $query->where('subject_id', '=', $subjectId );
               
                })->get();

			foreach ($teacherObject as $name)
				array_push($teachers,$name);

			
		}

		$teachersNames = array();

		foreach ($teachers as $names) {

			array_push($teachersNames,$name->name);
		}

		var_dump($teachersNames);


		$teachers = Teacher::all();

		$teachers_ids = array();

		


		return "hola";
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

		$options =  json_encode([$option1, $option2, $option3, $option4, $option5]);
		
		return view('test.viewOption',[
					'options' => $options,
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
