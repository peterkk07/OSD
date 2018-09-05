<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;
use OSD\Http\Requests;
use Illuminate\Support\Facades\Auth;
use OSD\Teacher;
use OSD\Coordinator;
use OSD\Semester;
use OSD\Subject;
use OSD\Section;
use OSD\KnowledgeArea;
use OSD\SubKnowledgeArea;
use OSD\Student;
use OSD\SurveyEvaluation;
use OSD\SubjectProgramming;
use OSD\SemesterSurvey;
use OSD\SurveyOption;
use OSD\SurveyQuestion;
use OSD\StudentProgramming;
use DB;

class InternalController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }

    
	public function index() {

		if (Auth::user()){

            return view('internal.internalHome');
        }

        return redirect('/logout');

	}

	public function pickUserEvaluation() {

		$teachers = Teacher::all();
		$semesters = Semester::all();
		$subjects = Subject::all();
		$sections = Section::all();
		$subKnowledgeAreas = SubKnowledgeArea::all();
		$knowledgeAreas = KnowledgeArea::all();



		if( Auth::user() ){

            return view('internal.pickUserEvaluation')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        }

        return redirect('/logout');
	}

	/*evaluacion personal de un profesor*/

	public function pickTeacherEvaluation() {


		if ( Auth::user()->type_user->description == "Profesor"){

			$teacherId = Teacher::where("ci",Auth::user()->ci)->first()->id;

			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
		
            return view('internal.pickTeacherEvaluation')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas','teacherId'));
		}


        return redirect('/logout');
	}



	public function pickKnowledgeAreaEvaluation() {

		if( Auth::user()->type_user->description == 'Director' ){

			$teachers = Teacher::all();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			$subKnowledgeAreas = SubKnowledgeArea::all();
			$knowledgeAreas = KnowledgeArea::all();

            return view('internal.pickKnowledgeArea')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        }

        if( Auth::user()->type_user->description == 'Coordinador_areas' ){


			$teachers = Teacher::all();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			
			$CoordinatorId = Coordinator::where('ci',Auth::user()->ci)->first()->id;

			$Coordinator = Coordinator::find($CoordinatorId);


			$knowledgeAreas = KnowledgeArea::where('id',$Coordinator->knowledge_area->id)->get();


            return view('internal.pickKnowledgeArea')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        }



        return redirect('/logout');
	}


	public function pickSubKnowledgeAreaEvaluation() {

		
		if( Auth::user()->type_user->description == 'Director' ){

			$teachers = Teacher::all();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			$subKnowledgeAreas = SubKnowledgeArea::all();
		

            return view('internal.pickSubKnowledgeArea')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        }

        if( Auth::user()->type_user->description == 'Coordinador_areas' ){

			$teachers = Teacher::all();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			
			$CoordinatorId = Coordinator::where('ci',Auth::user()->ci)->first()->id;

			$Coordinator = Coordinator::find($CoordinatorId);

			$subKnowledgeAreas = SubKnowledgeArea::where('knowledge_area_id',$Coordinator->knowledge_area->id)->get();

			
			$countSubAreas = count($subKnowledgeAreas);

			if ($countSubAreas==0)
				return view('internal.emptySubArea');


            return view('internal.pickSubKnowledgeArea')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        }



        return redirect('/logout');
	}



/* ************************** EVALUACIÓN ***************************************************/
/* ************************** INDIVIDUAL ***************************************************/
/* **************************         ***************************************************/
	
	public function showChart(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$TeacherId = $request["teacher"];

		$SubjectId = $request["subject"];
		
		$SubjectName = Subject::find($SubjectId);

		$SemesterId = $request["semester"];

		$SectionId = $request["section"];

		$questionRequest = $request["question"];

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$surveyQuestionNames = SurveyQuestion::where("survey_id",$surveyId)->pluck("description");

		$SurveyOptions = SurveyOption::all();

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;

		$studentsIds = Student::whereHas('subject_programming', function($q) use ($TeacherId,$SemesterId,$SubjectId,$SectionId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $SemesterId,
		    'subject_id' => $SubjectId,
		    'section_id' => $SectionId

		]);})->pluck("id");

		/*Cantidad de usuarios pertenecientes a esta materia*/


		$studentAnswered = Student::whereHas('subject_programming', function($q) use ($TeacherId,$SemesterId,$SubjectId,$SectionId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $SemesterId,
		    'subject_id' => $SubjectId,
		    'section_id' => $SectionId

		]);})->where('answered','1')->pluck("id");
	

		$CountStudentsSubject = count($studentsIds);

		if ($CountStudentsSubject == 0) 
				return response()->json(['error-consulta' => "error-consulta"]);
			

		$CountStudentsAnswered = count($studentAnswered);

		$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";



		/*Programacion de la materia que se esta buscando*/

		$SubjectProgrammingId = SubjectProgramming::where([
													    'teacher_id' =>  $TeacherId,
														'semester_id' => $SemesterId,
														'subject_id' => $SubjectId,
														'section_id' => $SectionId
													])->first()->id;

		/*Tomar todas las evaluaciones de la encuesta	*/

		$surveyEvaluationsIds = array();

		foreach ($studentsIds as $studentId) {


			$studentProgrammingId = StudentProgramming::where([
												    'student_id' =>  $studentId,
												    'subject_programming_id' => $SubjectProgrammingId
												])->first()->id;


			$SurveyEvaluationId = SurveyEvaluation::where([
												    'student_id' =>  $studentId,
												    'semester_survey_id' => $semesterSurveyId,
												    'student_programming_id' => $studentProgrammingId
												])->first()->id;
			
			array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
		
		}


		$countAll = array();

		$querieConditions = "";

 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

			if ($i == count($surveyEvaluationsIds)-1){
				
				$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

				break;
			}

			$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
		}

			if ($querieConditions == "") {

				return response()->json([
									'error-consulta' => "error-consulta",
									
				]);
			}
			

		foreach($SurveyOptions as $option) {
				
			foreach($surveyQuestionIds as $QuestionId) {

				$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

				$results = DB::select( DB::raw($querie));

				array_push($countAll , count($results));

			}
		}

		/*data para charts sin formatear*/

		$items = array_chunk($countAll, 5);

		/*Si es para visualizar las preguntas globalmente */

		if ($questionRequest == "global-question"){

			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=count($surveyQuestionIds); $i++){

				$element ="Pregunta ".$i;

				array_push($Labels , $element);
			}

			$option1 = array();
			$option2 = array();
			$option3 = array();
			$option4 = array();
			$option5 = array();


			/*Data para la tabla de estadisticcas*/

			for ( $i=0 ; $i<count($items); $i++) {

				array_push($option1  ,$items[$i][0]);
				array_push($option2  ,$items[$i][1]);
				array_push($option3  ,$items[$i][2]);
				array_push($option4  ,$items[$i][3]);
				array_push($option5  ,$items[$i][4]);
			
			}

		/*	$questionsTable = array();

			foreach($surveyQuestionIds as $key=>$value) {

				$keyTemp = $key+1;
				$question = array("Pregunta $keyTemp");

				array_push($questionsTable  ,$question);

			}*/

			$questionsTable = array();

			foreach($surveyQuestionNames as $questions) {
				
				$question = array($questions);

				array_push($questionsTable ,$question);
			}

			/*Datos para porcentajes de tabla */

			$items2 = $items;

			$itemspocentaje = $items;

			for ($i=0; $i<19; $i++) {

				for ($j=0; $j<5; $j++){

					$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

					if($sum == 0){
						$itemspocentaje[$i][$j]= 0;
					}else{
						$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
					}
				}

			}


			return response()->json([
									'option1' => $option1,
									'option2' => $option2,
									'option3' => $option3,
									'option4' => $option4,
									'option5' => $option5,
									'labels' => $Labels,
									'items' => $items,
									'questionsTable' => $questionsTable,
									'itemspocentaje' => $itemspocentaje,
									'type_request' => "global",
									'SubjectName' => $SubjectName->name,
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage

									]);

		}


		/* Estadísticas para una pregunta especifica*/

		$questionRequest = $request["question"];

		$questions = array();


		foreach ($surveyQuestionIds as $Id) {

			$survey_question = SurveyQuestion::find($Id);

			array_push($questions, $survey_question->description);

		}
	
		/*Etiquetas para el chartjs*/

		$Labels = array();

		for ($i=1; $i<=5; $i++){

			$element ="Opción ".$i;

			array_push($Labels , $element);
		}


		/*data para la pregunta especifica*/

		$data = $items[$questionRequest];

		return response()->json([
								
								'labels' => $Labels,
								'items' => $data,
								'type_request' => "specific",
								'question' => $questions[$questionRequest],
								'CountStudentsAnswered' => $CountStudentsAnswered,
								'CountStudentPercentage' => $CountStudentPercentage

								]);
	
	}
	
/*actualizar los campos de select , según el área de conocimiento proporcionada*/
	

	public function updateKnowledgeArea(Request $request) {


		/*filtrar elementos repetidos*/
		function unique_multidim_array($array, $key) { 
					    $temp_array = array(); 
					    $i = 0; 
					    $key_array = array(); 
					    
					    foreach($array as $val) { 
					        if (!in_array($val[$key], $key_array)) { 
					            $key_array[$i] = $val[$key]; 
					            $temp_array[$i] = $val; 
					        } 
					        $i++; 
					    } 
					    return $temp_array; 
		} 


		$KnowledgeArea = KnowledgeArea::find($request["knowledgeArea"]);

		$SemesterId = $request["semesterId"]; 

		/*Nombres de sub areas de conocimiento*/
		
		$SubKnowledgeAreaNames = array();
		$SubKnowledgeAreaIds = array();

		foreach ($KnowledgeArea->subKnowledgeArea as $data){

			array_push($SubKnowledgeAreaNames,$data["name"]);
			array_push($SubKnowledgeAreaIds ,$data["id"]);
		}
			 
		$subjectsIds = array();

		foreach ($KnowledgeArea->subject as $data){

			array_push($subjectsIds,$data["id"]);
		}

		/*Nombres de materias*/

		$subjectNames = array();

		foreach ($subjectsIds as $Ids) {

			$subject = Subject::find($Ids);
			array_push($subjectNames,$subject->name);

		}	
			
		$teachers = array();
		$teachersNames = array();
		$teachersIds = array();

		foreach ($KnowledgeArea->subject as $data){

			$subjectId = $data["id"];


			$teacherObject = SubjectProgramming::where([
											    'subject_id' =>  $data["id"],
											    'semester_id' => $SemesterId,
											])->get();
			

			foreach ($teacherObject as $name){

				array_push($teachers,$name->teacher_id);
			}
		}


		/*Nombres e Ids de profesores */

		foreach($teachers as $teacherId) {

			$teacherName = Teacher::find($teacherId);

			array_push($teachersNames,$teacherName->name);
			array_push($teachersIds,$teacherId);

		}


		/*Nombre de las secciones */

		$sections = array();
		$sectionsIds = array();


		foreach($subjectsIds as $subjectId){


			$sectionObject = SubjectProgramming::where([
											    'subject_id' =>  $subjectId,
											    'semester_id' => $SemesterId,
											])->get();
			
		
			foreach ($sectionObject as $data) {
				
				$section = Section::find($data->section_id);

				array_push($sections,$section->name);
				array_push($sectionsIds,$section->id);

			}

		}

		$sectionName = array_unique($sections);

		$sectionId = array_unique($sectionsIds);
		
		return response()->json(
								['subKnowledgeAreas' => $SubKnowledgeAreaNames,
								 'SubKnowledgeAreaIds' => $SubKnowledgeAreaIds,
								 'subjectNames' => $subjectNames,
								 'subjectsIds' => $subjectsIds,
								 'teachersNames' => $teachersNames,
								 'teachersIds' => $teachersIds,
								 'sections' => $sectionName,
								 'sectionsIds' => $sectionId

								]

								);

	}
	
	/*Actualizar sub area de conocimiento 	*/

	public function updateSubKnowledgeArea(Request $request) {


		$SemesterId = $request["semesterId"]; 

		$SubKnowledgeArea = SubKnowledgeArea::find($request["SubKnowledgeArea"]);

		/*Ids de materias */ 

		$subjectsIds = array();

		foreach ($SubKnowledgeArea->subject as $data){

			array_push($subjectsIds,$data["id"]);
		}

		/*Nombres de materias*/

		$subjectNames = array();

		foreach ($subjectsIds as $Ids) {

			$subject = Subject::find($Ids);
			array_push($subjectNames,$subject->name);

		}	
			
		$teachers = array();
		$teachersIds = array();

		foreach ($SubKnowledgeArea->subject as $data){

			$subjectId = $data["id"];

			$teacherObject = Teacher::whereHas('subject',  function($query) use ($subjectId) {
                
                $query->where('subject_id', '=', $subjectId );
               
                })->get();

			foreach ($teacherObject as $name)
				array_push($teachers,$name);
		}

		/*Nombres de profesores*/
		$teachersNames = array();

		foreach ($teachers as $data) {

			array_push($teachersNames,$data->name);
			array_push($teachersIds,$data->id);
		}


		/*Nombre de las secciones */

		$sections = array();
		$sectionsIds = array();


		foreach($subjectsIds as $subjectId){


			$sectionObject = SubjectProgramming::where([
											    'subject_id' =>  $subjectId,
											    'semester_id' => $SemesterId,
											])->get();
			
		
			foreach ($sectionObject as $data) {
				
				$section = Section::find($data->section_id);

				array_push($sections,$section->name);
				array_push($sectionsIds,$section->id);

			}

		}

		$sectionName = array_unique($sections);

		$sectionId = array_unique($sectionsIds);

		
		return response()->json(
								[
								 'subjectNames' => $subjectNames,
								 'subjectsIds' => $subjectsIds,
								 'teachersNames' => $teachersNames,
								 'teachersIds' => $teachersIds,
								 'sectionName' => $sectionName,
								 'sectionId' => $sectionId

								]

								);

	}

	/*Actualizar al seleccionar materias*/

	public function updateSubject(Request $request) {


		$Subject = Subject::find($request["Subject"]);
		
		$SemesterId = $request["semesterId"]; 


		$knowledgeAreaId = $Subject->knowledge_area["id"];
		$knowledgeAreaName = $Subject->knowledge_area["name"];

		$subknowledgeAreaId = $Subject->sub_knowledge_area["id"];
		$subknowledgeAreaName = $Subject->sub_knowledge_area["name"];

		$subjectId = $request["Subject"];

		$teachersId = array();
		$teachersNames = array();

		$teacherObject = Teacher::whereHas('subject',  function($query) use ($subjectId) {
                
            $query->where('subject_id', '=', $subjectId );
               
                })->get();


		foreach ($teacherObject as $data){

			array_push($teachersId,$data["id"]);
			array_push($teachersNames,$data["name"]);

		}

		/*obtener secciones*/

		$sections = array();
		$sectionsIds = array();

		$sectionObject = SubjectProgramming::where([
											    'subject_id' =>  $subjectId,
											    'semester_id' => $SemesterId,
											])->get();


		foreach ($sectionObject as $data) {
				
				$section = Section::find($data->section_id);

				array_push($sections,$section->name);
				array_push($sectionsIds,$section->id);

		}


		$sectionName = array_unique($sections);

		$sectionId = array_unique($sectionsIds);

		
		return response()->json(
								[
								 'knowledgeAreaId' => $knowledgeAreaId,
								 'knowledgeAreaName' => $knowledgeAreaName,
								 'subknowledgeAreaId' => $subknowledgeAreaId,
								 'subknowledgeAreaName' => $subknowledgeAreaName,
								 'teachersId' => $teachersId,
								 'teachersNames' => $teachersNames,
								 'sectionName' => $sectionName,
								 'sectionId' => $sectionId
								]

								);
	}


		/*Actualizar preguntas segun semestre*/

	public function updateQuestion(Request $request) {


		$semesterId = $request["semester"];

		$surveyId = SemesterSurvey::where("semester_id",$semesterId)->first()->id;

		$questionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$questionNames = array();

		$IdQuestion = array();


		foreach ($questionIds as $key => $questionId) {

			$question = SurveyQuestion::find($questionId);

			array_push($questionNames ,$question->description);
			array_push($IdQuestion , $key);

		}

		return response()->json(
								[
								 'questionNames' => $questionNames,
								 'questionId' => $IdQuestion
								]

								);
	}


		/*Actualizar opciones de la evaluacion del profesor segun semestre*/

	public function updateTeacherOptions(Request $request) {


		$semesterId = $request["semester"];

		$teacherId = $request["teacher_id"];

		$surveyId = SemesterSurvey::where("semester_id",$semesterId)->first()->id;

		$questionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$questionNames = array();

		$IdQuestion = array();


		foreach ($questionIds as $key => $questionId) {

			$question = SurveyQuestion::find($questionId);

			array_push($questionNames ,$question->description);
			array_push($IdQuestion , $key);

		}

		$subjectNames = array();
		$subjectIds = array();

		$sectionNames = array();
		$sectionIds = array();


		$programmingObject = SubjectProgramming::where([
											    'teacher_id' =>  $teacherId,
											    'semester_id' => $semesterId,
											])->get();

		foreach ($programmingObject as $data) {

			
			$subjectName = Subject::find($data->subject_id);
			
			array_push($subjectIds , $data->subject_id);
			array_push($subjectNames , $subjectName->name);


			$sectionName = Section::find($data->section_id);

			array_push($sectionIds , $data->section_id);
			array_push($sectionNames , $sectionName->name);


		}


		return response()->json(
								[
								 'questionNames' => $questionNames,
								 'questionId' => $IdQuestion,
								 'subjectIds' => $subjectIds,
								 'subjectNames' => $subjectNames,
								 'sectionIds' => $sectionIds,
								 'sectionNames' => $sectionNames,

								]

								);
	}


	

	/* ************************** EVALUACIÓN **************************************************/
   /* ************************** COLECTIVA ***************************************************/
  /* **************************  ÁREAS DE CONOCIMIENTO ***************************************/


  		public function showChartArea(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$KnowledgeAreaId = $request["knowledgeArea"];

		$SubjectId = $request["subject"];
		
		$SubjectName = Subject::find($SubjectId);

		$SemesterId = $request["semester"];

		$questionRequest = $request["question"];

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$SurveyOptions = SurveyOption::all();

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;


		$students = Student::all();

		/* GLOBAL SUBJECT*/

		if ( $SubjectId !="global-subject"){

			/*Programacion de la materia que se esta buscando*/

			$SubjectProgrammingId = SubjectProgramming::where([
														'semester_id' => $SemesterId,
														'subject_id' => $SubjectId,
													])->first();

			if ($SubjectProgrammingId == NULL) 
					return response()->json(['error-consulta' => "error-consulta"]);



			$studentsIds = Student::whereHas('subject_programming', function($q) use ($SemesterId,$SubjectId) {
        
	        $q->where([
			   
			    'semester_id' => $SemesterId,
			    'subject_id' => $SubjectId,
			   
			]);})->pluck("id");


			/*Contar estudiantes encuestados*/

			$CountStudentsAnswered = Student::whereHas('subject_programming', function($q) use ($SemesterId,$SubjectId) {
        
	        $q->where([
			   
			    'semester_id' => $SemesterId,
			    'subject_id' => $SubjectId,
			   
			]);})->where('answered','1')->pluck("id");


			$CountStudentsSubject = count($studentsIds);

			if ($CountStudentsSubject == 0) 
					return response()->json(['error-consulta' => "error-consulta"]);
				

			$CountStudentsAnswered = count($CountStudentsAnswered);

			$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";



			/*Tomar todas las evaluaciones de la encuesta	*/

			$surveyEvaluationsIds = array();

			foreach ($studentsIds as $studentId) {

				$studentProgrammingId = StudentProgramming::where([
													    'student_id' =>  $studentId,
													    'subject_programming_id' => $SubjectProgrammingId->id
													])->first()->id;


				$SurveyEvaluationId = SurveyEvaluation::where([
													    'student_id' =>  $studentId,
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $studentProgrammingId
													])->first()->id;
				
				array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
			
			}


			$countAll = array();

			$querieConditions = "";

	 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

				if ($i == count($surveyEvaluationsIds)-1){
					
					$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

					break;
				}

				$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
			}

				if ($querieConditions == "") {

					return response()->json([
										'error-consulta' => "error-consulta",
										
					]);
				}
				

			foreach($SurveyOptions as $option) {
					
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));

					array_push($countAll , count($results));

				}
			}

			/*data para charts sin formatear*/

			$items = array_chunk($countAll, 5);


			if ($questionRequest == "global-question"){

			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=count($surveyQuestionIds); $i++){

				$element ="Pregunta ".$i;

				array_push($Labels , $element);
			}

			$option1 = array();
			$option2 = array();
			$option3 = array();
			$option4 = array();
			$option5 = array();


			/*Data para la tabla de estadisticcas*/

			for ( $i=0 ; $i<count($items); $i++) {

				array_push($option1  ,$items[$i][0]);
				array_push($option2  ,$items[$i][1]);
				array_push($option3  ,$items[$i][2]);
				array_push($option4  ,$items[$i][3]);
				array_push($option5  ,$items[$i][4]);
			
			}

			$questionsTable = array();

			foreach($surveyQuestionIds as $key=>$value) {

				$keyTemp = $key+1;
				$question = array("Pregunta $keyTemp");

				array_push($questionsTable  ,$question);

			}

			/*Datos para porcentajes de tabla */

			$items2 = $items;

			$itemspocentaje = $items;

			for ($i=0; $i<19; $i++) {

				for ($j=0; $j<5; $j++){

					$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

					if($sum == 0){
						$itemspocentaje[$i][$j]= 0;
					}else{
						$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
					}
				}

			}

			return response()->json([
									'option1' => $option1,
									'option2' => $option2,
									'option3' => $option3,
									'option4' => $option4,
									'option5' => $option5,
									'labels' => $Labels,
									'items' => $items,
									'questionsTable' => $questionsTable,
									'itemspocentaje' => $itemspocentaje,
									'type_request' => "global",
									'SubjectName' => "$SubjectName->name",
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage

									]);

		}

		/* Estadísticas para una pregunta especifica*/

		$questionRequest = $request["question"];

		$questions = array();


		foreach ($surveyQuestionIds as $Id) {

			$survey_question = SurveyQuestion::find($Id);

			array_push($questions, $survey_question->description);

		}
	
		/*Etiquetas para el chartjs*/

		$Labels = array();

		for ($i=1; $i<=5; $i++){

			$element ="Opción ".$i;

			array_push($Labels , $element);
		}


		/*data para la pregunta especifica*/

		$data = $items[$questionRequest];

		return response()->json([
								
								'labels' => $Labels,
								'items' => $data,
								'type_request' => "specific",
								'question' => $questions[$questionRequest],
								'CountStudentsAnswered' => $CountStudentsAnswered,
								'CountStudentPercentage' => $CountStudentPercentage

								]);
	
	
	}

		/*END SPECIFIC SUBJECT*/


		/* GLOBAL SUBJECT*/

		if ( $SubjectId =="global-subject"){

			$SubjectsIds = Subject::where("knowledge_area_id",$KnowledgeAreaId)->pluck("id");


			$SubjectProgrammingIds = array();


			foreach($SubjectsIds as $subjects) {

				$SubjectProgramming  = SubjectProgramming::where([
															'semester_id' => $SemesterId,
															'subject_id' => $subjects,
														])->first();

				if ($SubjectProgramming == NULL)
					continue;

				array_push($SubjectProgrammingIds , $SubjectProgramming->id);

			}


			$StudentProgramming = array();

			foreach ($SubjectProgrammingIds as $SubjectProgrammingId){

				$studentProgramming = StudentProgramming::where([
													    'subject_programming_id' => $SubjectProgrammingId
													])->pluck("student_id");

				foreach ($studentProgramming as $programming)
					array_push($StudentProgramming , $programming);
			}



			/*Contar estudiantes encuestados*/

			$studentAnswered = array();
			
			foreach ($StudentProgramming as $student_id){

				$student = Student::find($student_id);

					if ($student->answered =='1')
						array_push($studentAnswered , $student->id);
			}


			$CountStudentsSubject = count($StudentProgramming);

			if ($CountStudentsSubject == 0) 
					return response()->json(['error-consulta' => "error-consulta"]);
				

			$CountStudentsAnswered = count($studentAnswered);

			$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";



			/*Tomar todas las evaluaciones de la encuesta	*/

			$surveyEvaluationsIds = array();

			foreach ($StudentProgramming as $programmingId) {


				$SurveyEvaluationId = SurveyEvaluation::where([
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $programmingId
													])->first()->id;
				
				array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
			
			}


			$countAll = array();

			$querieConditions = "";

	 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

				if ($i == count($surveyEvaluationsIds)-1){
					
					$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

					break;
				}

				$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
			}

			if ($querieConditions == "") {

				return response()->json([
									'error-consulta' => "error-consulta",
									
				]);
			}


			
			foreach($SurveyOptions as $option) {
				
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));

					array_push($countAll , count($results));

				}
			}

		/*data para charts sin formatear*/

			$items = array_chunk($countAll, 5);


			/*Si es para visualizar las preguntas globalmente */

		if ($questionRequest == "global-question"){

			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=count($surveyQuestionIds); $i++){

				$element ="Pregunta ".$i;

				array_push($Labels , $element);
			}

			$option1 = array();
			$option2 = array();
			$option3 = array();
			$option4 = array();
			$option5 = array();


			/*Data para la tabla de estadisticcas*/

			for ( $i=0 ; $i<count($items); $i++) {

				array_push($option1  ,$items[$i][0]);
				array_push($option2  ,$items[$i][1]);
				array_push($option3  ,$items[$i][2]);
				array_push($option4  ,$items[$i][3]);
				array_push($option5  ,$items[$i][4]);
			
			}

			$questionsTable = array();

			foreach($surveyQuestionIds as $key=>$value) {

				$keyTemp = $key+1;
				$question = array("Pregunta $keyTemp");

				array_push($questionsTable  ,$question);

			}

			/*Datos para porcentajes de tabla */

			$items2 = $items;

			$itemspocentaje = $items;

			for ($i=0; $i<19; $i++) {

				for ($j=0; $j<5; $j++){

					$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

					if($sum == 0){
						$itemspocentaje[$i][$j]= 0;
					}else{
						$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
					}
				}

			}

			return response()->json([
									'option1' => $option1,
									'option2' => $option2,
									'option3' => $option3,
									'option4' => $option4,
									'option5' => $option5,
									'labels' => $Labels,
									'items' => $items,
									'questionsTable' => $questionsTable,
									'itemspocentaje' => $itemspocentaje,
									'type_request' => "global",
									'SubjectName' => "global-subject",
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage

									]);

		}

		/* Estadísticas para una pregunta especifica*/

		$questionRequest = $request["question"];

		$questions = array();


		foreach ($surveyQuestionIds as $Id) {

			$survey_question = SurveyQuestion::find($Id);

			array_push($questions, $survey_question->description);

		}
	
		/*Etiquetas para el chartjs*/

		$Labels = array();

		for ($i=1; $i<=5; $i++){

			$element ="Opción ".$i;

			array_push($Labels , $element);
		}


		/*data para la pregunta especifica*/

		$data = $items[$questionRequest];

		return response()->json([
								
								'labels' => $Labels,
								'items' => $data,
								'type_request' => "specific",
								'question' => $questions[$questionRequest],
								'CountStudentsAnswered' => $CountStudentsAnswered,
								'CountStudentPercentage' => $CountStudentPercentage

								]);
	
	
	}
}
		

		/* ************************** EVALUACIÓN **************************************************/
   /* ************************** COLECTIVA ***************************************************/
  /* ************************** SUB  ÁREAS DE CONOCIMIENTO ***************************************/


  		public function showChartSubArea(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$SubKnowledgeAreaId = $request["subKnowledgeArea"];

		$SubjectId = $request["subject"];
		
		$SubjectName = Subject::find($SubjectId);

		$SemesterId = $request["semester"];

		$questionRequest = $request["question"];

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$SurveyOptions = SurveyOption::all();

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;



		$students = Student::all();

		$studentAnswered = array();

		foreach ($students as $student) {

			if ($student->answered == "1")
				array_push($studentAnswered ,$student->id);
	
		}

		$CountStudentsSubject = count($students);

		$CountStudentsAnswered = count($studentAnswered);

		$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";

				/* GLOBAL SUBJECT*/

		if ( $SubjectId !="global-subject"){

			/*Programacion de la materia que se esta buscando*/

			$SubjectProgrammingId = SubjectProgramming::where([
														'semester_id' => $SemesterId,
														'subject_id' => $SubjectId,
													])->first();


			if ($SubjectProgrammingId == NULL) 
					return response()->json(['error-consulta' => "error-consulta"]);



			$studentsIds = Student::whereHas('subject_programming', function($q) use ($SemesterId,$SubjectId) {
        
	        $q->where([
			   
			    'semester_id' => $SemesterId,
			    'subject_id' => $SubjectId,
			   
			]);})->pluck("id");



			/*Tomar todas las evaluaciones de la encuesta	*/

			$surveyEvaluationsIds = array();

			foreach ($studentsIds as $studentId) {

				$studentProgrammingId = StudentProgramming::where([
													    'student_id' =>  $studentId,
													    'subject_programming_id' => $SubjectProgrammingId
													])->first()->id;


				$SurveyEvaluationId = SurveyEvaluation::where([
													    'student_id' =>  $studentId,
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $studentProgrammingId
													])->first()->id;
				
				array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
			
			}


			$countAll = array();

			$querieConditions = "";

	 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

				if ($i == count($surveyEvaluationsIds)-1){
					
					$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

					break;
				}

				$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
			}

				if ($querieConditions == "") {

					return response()->json([
										'error-consulta' => "error-consulta",
										
					]);
				}
				

			foreach($SurveyOptions as $option) {
					
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));

					array_push($countAll , count($results));

				}
			}

			/*data para charts sin formatear*/

			$items = array_chunk($countAll, 5);


			if ($questionRequest == "global-question"){

			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=count($surveyQuestionIds); $i++){

				$element ="Pregunta ".$i;

				array_push($Labels , $element);
			}

			$option1 = array();
			$option2 = array();
			$option3 = array();
			$option4 = array();
			$option5 = array();


			/*Data para la tabla de estadisticcas*/

			for ( $i=0 ; $i<count($items); $i++) {

				array_push($option1  ,$items[$i][0]);
				array_push($option2  ,$items[$i][1]);
				array_push($option3  ,$items[$i][2]);
				array_push($option4  ,$items[$i][3]);
				array_push($option5  ,$items[$i][4]);
			
			}

			$questionsTable = array();

			foreach($surveyQuestionIds as $key=>$value) {

				$keyTemp = $key+1;
				$question = array("Pregunta $keyTemp");

				array_push($questionsTable  ,$question);

			}

			/*Datos para porcentajes de tabla */

			$items2 = $items;

			$itemspocentaje = $items;

			for ($i=0; $i<19; $i++) {

				for ($j=0; $j<5; $j++){

					$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

					if($sum == 0){
						$itemspocentaje[$i][$j]= 0;
					}else{
						$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
					}
				}

			}

	

			return response()->json([
									'option1' => $option1,
									'option2' => $option2,
									'option3' => $option3,
									'option4' => $option4,
									'option5' => $option5,
									'labels' => $Labels,
									'items' => $items,
									'questionsTable' => $questionsTable,
									'itemspocentaje' => $itemspocentaje,
									'type_request' => "global",
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage,
									'SubjectName' => $SubjectName->name

									]);

		}

		/* Estadísticas para una pregunta especifica*/

		$questionRequest = $request["question"];

		$questions = array();


		foreach ($surveyQuestionIds as $Id) {

			$survey_question = SurveyQuestion::find($Id);

			array_push($questions, $survey_question->description);

		}
	
		/*Etiquetas para el chartjs*/

		$Labels = array();

		for ($i=1; $i<=5; $i++){

			$element ="Opción ".$i;

			array_push($Labels , $element);
		}


		/*data para la pregunta especifica*/

		$data = $items[$questionRequest];

		return response()->json([
								
								'labels' => $Labels,
								'items' => $data,
								'type_request' => "specific",
								'question' => $questions[$questionRequest],
								'CountStudentsAnswered' => $CountStudentsAnswered,
								'CountStudentPercentage' => $CountStudentPercentage

								]);
	

	}

		/*END SPECIFIC SUBJECT*/


		/* GLOBAL SUBJECT*/

		if ( $SubjectId =="global-subject"){

			$SubjectsIds = Subject::where("sub_knowledge_area_id", $SubKnowledgeAreaId)->pluck("id");


			$SubjectProgrammingIds = array();


			foreach($SubjectsIds as $subjects) {

				$SubjectProgramming  = SubjectProgramming::where([
															'semester_id' => $SemesterId,
															'subject_id' => $subjects,
														])->first();

				if ($SubjectProgramming == NULL)
					continue;

				array_push($SubjectProgrammingIds , $SubjectProgramming->id);

			}


			$StudentProgramming = array();

			foreach ($SubjectProgrammingIds as $SubjectProgrammingId){

				$studentProgramming = StudentProgramming::where([
													    'subject_programming_id' => $SubjectProgrammingId
													])->pluck("student_id");

				foreach ($studentProgramming as $programming)
					array_push($StudentProgramming , $programming);
			}


			/*Tomar todas las evaluaciones de la encuesta	*/

			$surveyEvaluationsIds = array();

			foreach ($StudentProgramming as $programmingId) {


				$SurveyEvaluationId = SurveyEvaluation::where([
													    'semester_survey_id' => $semesterSurveyId,
													    'student_programming_id' => $programmingId
													])->first()->id;
				
				array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
			
			}


			$countAll = array();

			$querieConditions = "";

	 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

				if ($i == count($surveyEvaluationsIds)-1){
					
					$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

					break;
				}

				$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
			}

			if ($querieConditions == "") {

				return response()->json([
									'error-consulta' => "error-consulta",
									
				]);
			}


			
			foreach($SurveyOptions as $option) {
				
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));

					array_push($countAll , count($results));

				}
			}

		/*data para charts sin formatear*/

			$items = array_chunk($countAll, 5);


			/*Si es para visualizar las preguntas globalmente */

		if ($questionRequest == "global-question"){

			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=count($surveyQuestionIds); $i++){

				$element ="Pregunta ".$i;

				array_push($Labels , $element);
			}

			$option1 = array();
			$option2 = array();
			$option3 = array();
			$option4 = array();
			$option5 = array();


			/*Data para la tabla de estadisticcas*/

			for ( $i=0 ; $i<count($items); $i++) {

				array_push($option1  ,$items[$i][0]);
				array_push($option2  ,$items[$i][1]);
				array_push($option3  ,$items[$i][2]);
				array_push($option4  ,$items[$i][3]);
				array_push($option5  ,$items[$i][4]);
			
			}

			$questionsTable = array();

			foreach($surveyQuestionIds as $key=>$value) {

				$keyTemp = $key+1;
				$question = array("Pregunta $keyTemp");

				array_push($questionsTable  ,$question);

			}

			/*Datos para porcentajes de tabla */

			$items2 = $items;

			$itemspocentaje = $items;

			for ($i=0; $i<19; $i++) {

				for ($j=0; $j<5; $j++){

					$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

					if($sum == 0){
						$itemspocentaje[$i][$j]= 0;
					}else{
						$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
					}
				}

			}

			return response()->json([
									'option1' => $option1,
									'option2' => $option2,
									'option3' => $option3,
									'option4' => $option4,
									'option5' => $option5,
									'labels' => $Labels,
									'items' => $items,
									'questionsTable' => $questionsTable,
									'itemspocentaje' => $itemspocentaje,
									'type_request' => "global",
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage,
									'SubjectName' => "global-subject"


									]);

		}

		/* Estadísticas para una pregunta especifica*/

		$questionRequest = $request["question"];

		$questions = array();


		foreach ($surveyQuestionIds as $Id) {

			$survey_question = SurveyQuestion::find($Id);

			array_push($questions, $survey_question->description);

		}
	
		/*Etiquetas para el chartjs*/

		$Labels = array();

		for ($i=1; $i<=5; $i++){

			$element ="Opción ".$i;

			array_push($Labels , $element);
		}


		/*data para la pregunta especifica*/

		$data = $items[$questionRequest];

		return response()->json([
								
								'labels' => $Labels,
								'items' => $data,
								'type_request' => "specific",
								'question' => $questions[$questionRequest]

								]);
	
	
	}
}

		
		







/* ************************** EVALUACIÓN ***************************************************/
/* ************************** INDIVIDUAL ***************************************************/
/* **************************  PROFESOR  ***************************************************/
	

		/*Actualizar profesores*/

	public function updateTeacher(Request $request) {


		$TeacherId = $request["TeacherId"];

		$TeachersIds = array();

		$SubjectIds = array();

		$SubjectNames = array();

		$knowledgeAreaIds = array();

		$knowledgeAreaNames = array();

		$subKnowledgeAreaIds = array();

		$subKnowledgeAreaNames = array();

		$sections = array();

		$sectionsIds = array();


		$SubjectObject =  SubjectProgramming::where("teacher_id",$TeacherId)->get();


		foreach ($SubjectObject as $data) {

			array_push($TeachersIds,$data["teacher_id"]);
			array_push($SubjectIds,$data["subject_id"]);
		}

		$SubjectIds = array_unique($SubjectIds);

		foreach($SubjectIds as $data) {

			$subjectName = Subject::find($data);
			
			array_push($SubjectNames,$subjectName->name);

			array_push($knowledgeAreaIds,$subjectName->knowledge_area["id"]);

			array_push($knowledgeAreaNames,$subjectName->knowledge_area["name"]);

			array_push($subKnowledgeAreaIds,$subjectName->sub_knowledge_area["id"]);

			array_push($subKnowledgeAreaNames,$subjectName->sub_knowledge_area["name"]);


			$sectionObject = SubjectProgramming::where([
											    'subject_id' =>  $data
											])->get();
			
		
			foreach ($sectionObject as $datas) {

				$section = Section::find($datas->section_id);

				array_push($sections,$section->name);
				array_push($sectionsIds,$section->id);

			}

		}

		
		return response()->json(
								[
								 'knowledgeAreaIds' => $knowledgeAreaIds,
								 'knowledgeAreaNames' => $knowledgeAreaNames,
								 'subKnowledgeAreaIds' => $subKnowledgeAreaIds,
								 'subKnowledgeAreaNames' => $subKnowledgeAreaNames,
								 'subjectNames' => $SubjectNames,
								 'subjectIds' => $SubjectIds,
								 'sectionName' => $sections,
								 'sectionId' => $sectionsIds

								]

								
								);
	}



  		public function showChartTeacher(Request $request) {

			/*todos los estudiantes que tienen programacion de materia con este profesor*/

			$TeacherId = $request["teacher_id"];

			$SubjectId = $request["subject"];
			
			$SubjectName = Subject::find($SubjectId);

			$SemesterId = $request["semester"];

			$questionRequest = $request["question"];

			$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

			$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

			$SurveyOptions = SurveyOption::all();

			$semesterSurveyId = SemesterSurvey::where([
										    'semester_id' =>  $SemesterId,
										    'survey_id' => $surveyId
											])->first()->id;


			$sectionId = $request["section"];

			$students = Student::all();

	
					/* GLOBAL SUBJECT*/

			if ( $SubjectId !="global-subject"){

				/*Programacion de la materia que se esta buscando*/


				$SubjectProgrammingId = SubjectProgramming::where([
															'semester_id' => $SemesterId,
															'subject_id' => $SubjectId,
															'section_id' => $sectionId
														])->first()->id;


				$studentsIds = Student::whereHas('subject_programming', function($q) use ($SemesterId,$SubjectId, $sectionId) {
	        
		        $q->where([
				   
				    'semester_id' => $SemesterId,
				    'subject_id' => $SubjectId,
				    'section_id' => $sectionId
				   
				]);})->pluck("id");


				
				$studentAnswered = Student::whereHas('subject_programming', function($q) use ($SemesterId,$SubjectId,$sectionId) {
	        
		        $q->where([
				   
				    'semester_id' => $SemesterId,
				    'subject_id' => $SubjectId,
				    'section_id' => $sectionId
				   
				]);})->where("answered","1")->pluck("id");


				/*Estudiantes que respondieron la encuesta*/

				$CountStudentsSubject = count($studentsIds);

				$CountStudentsAnswered = count($studentAnswered);

				$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";

				/*Tomar todas las evaluaciones de la encuesta	*/

				$surveyEvaluationsIds = array();

				foreach ($studentsIds as $studentId) {

					$studentProgrammingId = StudentProgramming::where([
														    'student_id' =>  $studentId,
														    'subject_programming_id' => $SubjectProgrammingId
														])->first()->id;


					$SurveyEvaluationId = SurveyEvaluation::where([
														    'student_id' =>  $studentId,
														    'semester_survey_id' => $semesterSurveyId,
														    'student_programming_id' => $studentProgrammingId
														])->first()->id;
					
					array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
				
				}


				$countAll = array();

				$querieConditions = "";

		 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

					if ($i == count($surveyEvaluationsIds)-1){
						
						$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

						break;
					}

					$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
				}

					if ($querieConditions == "") {

						return response()->json([
											'error-consulta' => "error-consulta",
											
						]);
					}
					

				foreach($SurveyOptions as $option) {
						
					foreach($surveyQuestionIds as $QuestionId) {

						$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

						$results = DB::select( DB::raw($querie));

						array_push($countAll , count($results));

					}
				}

				/*data para charts sin formatear*/

				$items = array_chunk($countAll, 5);


				if ($questionRequest == "global-question"){

				/*Etiquetas para el chartjs*/

				$Labels = array();

				for ($i=1; $i<=count($surveyQuestionIds); $i++){

					$element ="Pregunta ".$i;

					array_push($Labels , $element);
				}

				$option1 = array();
				$option2 = array();
				$option3 = array();
				$option4 = array();
				$option5 = array();


				/*Data para la tabla de estadisticcas*/

				for ( $i=0 ; $i<count($items); $i++) {

					array_push($option1  ,$items[$i][0]);
					array_push($option2  ,$items[$i][1]);
					array_push($option3  ,$items[$i][2]);
					array_push($option4  ,$items[$i][3]);
					array_push($option5  ,$items[$i][4]);
				
				}

				$questionsTable = array();

				foreach($surveyQuestionIds as $key=>$value) {

					$keyTemp = $key+1;
					$question = array("Pregunta $keyTemp");

					array_push($questionsTable  ,$question);

				}

				/*Datos para porcentajes de tabla */

				$items2 = $items;

				$itemspocentaje = $items;

				for ($i=0; $i<19; $i++) {

					for ($j=0; $j<5; $j++){

						$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

						if($sum == 0){
							$itemspocentaje[$i][$j]= 0;
						}else{
							$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
						}
					}

				}

		

				return response()->json([
										'option1' => $option1,
										'option2' => $option2,
										'option3' => $option3,
										'option4' => $option4,
										'option5' => $option5,
										'labels' => $Labels,
										'items' => $items,
										'questionsTable' => $questionsTable,
										'itemspocentaje' => $itemspocentaje,
										'type_request' => "global",
										'CountStudentsAnswered' => $CountStudentsAnswered,
										'CountStudentPercentage' => $CountStudentPercentage,
										'SubjectName' => $SubjectName->name

										]);

			}

			/* Estadísticas para una pregunta especifica*/

			$questionRequest = $request["question"];

			$questions = array();


			foreach ($surveyQuestionIds as $Id) {

				$survey_question = SurveyQuestion::find($Id);

				array_push($questions, $survey_question->description);

			}
		
			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=5; $i++){

				$element ="Opción ".$i;

				array_push($Labels , $element);
			}


			/*data para la pregunta especifica*/

			$data = $items[$questionRequest];

			return response()->json([
									
									'labels' => $Labels,
									'items' => $data,
									'type_request' => "specific",
									'question' => $questions[$questionRequest],
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage

									]);
		
		
		
		}

			/*END SPECIFIC SUBJECT*/


			/* GLOBAL SUBJECT*/

			if ( $SubjectId =="global-subject"){

				$studentsIds = Student::whereHas('subject_programming', function($q) use ($SemesterId,$TeacherId) {
	        
		        $q->where([
				   
				    'semester_id' => $SemesterId,
				    'teacher_id' => $TeacherId,
				   
				]);})->pluck("id");




				/*Estudiantes que respondieron la encuesta*/

				$studentAnswered = Student::whereHas('subject_programming', function($q) use ($SemesterId,$TeacherId) {
	        
		        $q->where([
				   
				    'semester_id' => $SemesterId,
				    'teacher_id' => $TeacherId,
				   
				]);})->where('answered','1')->pluck("id");


				$CountStudentsSubject = count($studentsIds);

				$CountStudentsAnswered = count($studentAnswered);

				$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";



				/*Tomar todas las evaluaciones de la encuesta	*/

				$surveyEvaluationsIds = array();

				foreach ($studentsIds as $studentId) {

					$studentProgrammingId = StudentProgramming::where([
														    'student_id' =>  $studentId,
														])->first()->id;


					$SurveyEvaluationId = SurveyEvaluation::where([
														    'student_id' =>  $studentId,
														    'semester_survey_id' => $semesterSurveyId,
														    'student_programming_id' => $studentProgrammingId
														])->first()->id;
					
					array_push($surveyEvaluationsIds ,$SurveyEvaluationId);
				
				}


				$countAll = array();

				$querieConditions = "";

		 		for ($i=0; $i<count($surveyEvaluationsIds); $i++){

					if ($i == count($surveyEvaluationsIds)-1){
						
						$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

						break;
					}

					$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
				}

				if ($querieConditions == "") {

					return response()->json([
										'error-consulta' => "error-consulta",
										
					]);
				}


				
				foreach($SurveyOptions as $option) {
					
					foreach($surveyQuestionIds as $QuestionId) {

						$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

						$results = DB::select( DB::raw($querie));

						array_push($countAll , count($results));

					}
				}

			/*data para charts sin formatear*/

				$items = array_chunk($countAll, 5);


				/*Si es para visualizar las preguntas globalmente */

			if ($questionRequest == "global-question"){

				/*Etiquetas para el chartjs*/

				$Labels = array();

				for ($i=1; $i<=count($surveyQuestionIds); $i++){

					$element ="Pregunta ".$i;

					array_push($Labels , $element);
				}

				$option1 = array();
				$option2 = array();
				$option3 = array();
				$option4 = array();
				$option5 = array();


				/*Data para la tabla de estadisticcas*/

				for ( $i=0 ; $i<count($items); $i++) {

					array_push($option1  ,$items[$i][0]);
					array_push($option2  ,$items[$i][1]);
					array_push($option3  ,$items[$i][2]);
					array_push($option4  ,$items[$i][3]);
					array_push($option5  ,$items[$i][4]);
				
				}

				$questionsTable = array();

				foreach($surveyQuestionIds as $key=>$value) {

					$keyTemp = $key+1;
					$question = array("Pregunta $keyTemp");

					array_push($questionsTable  ,$question);

				}

				/*Datos para porcentajes de tabla */

				$items2 = $items;

				$itemspocentaje = $items;

				for ($i=0; $i<19; $i++) {

					for ($j=0; $j<5; $j++){

						$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

						if($sum == 0){
							$itemspocentaje[$i][$j]= 0;
						}else{
							$itemspocentaje[$i][$j]= round((($itemspocentaje[$i][$j]*100)/$sum),2)."%";
						}
					}

				}

				return response()->json([
										'option1' => $option1,
										'option2' => $option2,
										'option3' => $option3,
										'option4' => $option4,
										'option5' => $option5,
										'labels' => $Labels,
										'items' => $items,
										'questionsTable' => $questionsTable,
										'itemspocentaje' => $itemspocentaje,
										'type_request' => "global",
										'CountStudentsAnswered' => $CountStudentsAnswered,
										'CountStudentPercentage' => $CountStudentPercentage,
										'SubjectName' => "global-subject"


										]);

			}

			/* Estadísticas para una pregunta especifica*/

			$questionRequest = $request["question"];

			$questions = array();


			foreach ($surveyQuestionIds as $Id) {

				$survey_question = SurveyQuestion::find($Id);

				array_push($questions, $survey_question->description);

			}
		
			/*Etiquetas para el chartjs*/

			$Labels = array();

			for ($i=1; $i<=5; $i++){

				$element ="Opción ".$i;

				array_push($Labels , $element);
			}


			/*data para la pregunta especifica*/

			$data = $items[$questionRequest];

			return response()->json([
									
									'labels' => $Labels,
									'items' => $data,
									'type_request' => "specific",
									'question' => $questions[$questionRequest],
									'CountStudentsAnswered' => $CountStudentsAnswered,
									'CountStudentPercentage' => $CountStudentPercentage

									]);
		
		
		}
	}

		
	


} /*end class */
