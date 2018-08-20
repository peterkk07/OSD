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
use OSD\StudentProgramming;

class testController extends Controller
{
    
	public function index() {





/*////////////////////////////*//////////

		$TeacherId = 1;

		$SubjectId = 1;
		
		$SemesterId = 1;

		$SectionId = Section::where("name","01")->first()->id;

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$SurveyOptions = SurveyOption::all();

		/*$SurveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId);*/

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


		$SubjectProgrammingId = SubjectProgramming::where([
													    'teacher_id' =>  $TeacherId,
														'semester_id' => $SemesterId,
														'subject_id' => $SubjectId,
														'section_id' => $SectionId
													])->first()->id;

		/*id de las evaluaciones de encuesta del estudiante seleccionado*/

		$option1 = 0; 
		$option2 = 0;
		$option3 = 0;
		$option4 = 0;
		$option5 = 0;

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

		
 
 	/*opciones asociadas a las preguntas */

 	$option1Id = SurveyOption::where("description","1")->first()->id;
 	$option2Id = SurveyOption::where("description","2")->first()->id;
 	$option3Id = SurveyOption::where("description","3")->first()->id;
 	$option4Id = SurveyOption::where("description","4")->first()->id;
 	$option5Id = SurveyOption::where("description","5")->first()->id;

 	$countAll = array();

 	/*var_dump($surveyEvaluationsIds);

 	return "ids";*/

 	$SurveyEvaluationCount = count($surveyEvaluationsIds);


 	$querieConditions = "";

 	for ($i=0; $i<count($surveyEvaluationsIds); $i++){

			if ($i == count($surveyEvaluationsIds)-1){
				
				$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

				break;
			}

			$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
		}


			foreach($SurveyOptions as $option) {
				
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));


				/*	$SurveyAnswer = SurveyAnswer::where([
												'survey_evaluation_id' => $surveyEvaluation,
											    'survey_option_id' =>  $option->id,
											    'survey_question_id' => $QuestionId
											    
											])->count();*/
					
					
					
					
					array_push($countAll , count($results));

				}

			}

		

$items=array_chunk($countAll, 5);

	$nums = array();
	echo "<pre>";
	var_dump($items[0]);

	echo "</pre>";


return "pre";

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
			$question = array("pregunta $keyTemp");

			array_push($questionsTable  ,$question);

		}




$items2 = $items;


	for ($i=0; $i<19; $i++) {

		for ($j=0; $j<5; $j++){

			/*var_dump($items[$i][$j]);*/

			$sum = $items2[$i][0]+$items2[$i][1]+$items2[$i][2]+$items2[$i][3]+$items2[$i][4];

			/*var_dump($sum);*/

			if($sum == 0){
				$items[$i][$j]= 0;
			}else{
				$items[$i][$j]= (($items[$i][$j]*100)/$sum)."%";
			}
			

		}

	}

/*
var_dump($sum);
*/
/*	$nums = array();
	echo "<pre>";
	var_dump($items);

	echo "</pre>";
*/



	




return "aca";

return view('test')->with(compact('option1','option2','option3','option4','option5'));


return "aca";


/* *////////////////////////////////

$Labels = "";


	for ($i=1; $i<=count($surveyQuestionIds); $i++){

			if ($i == count($surveyQuestionIds)){
				
				$Labels .='Pregunta '.$i;

				break;
			}

				$Labels .='Pregunta '.$i.', ';
		}


$option1 = array();
$option2 = array();
$option3 = array();
$option4 = array();
$option5 = array();


		for ( $i=0 ; $i<count($items); $i++) {


			array_push($option1  ,$items[$i][0]);
			array_push($option2  ,$items[$i][1]);
			array_push($option3  ,$items[$i][2]);
			array_push($option4  ,$items[$i][3]);
			array_push($option5  ,$items[$i][4]);
		

		}


/*option 1= [0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0]

option 2= [0,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,1]*/



echo "<pre>";
var_dump($option2);

echo "</pre>";

return "labels";

		/*{
          type: 'bar',
          label: 'Dataset 1',
          backgroundColor: "red",
          data: [65, 10, 80, 81, 56, 85, 40, 10, 25 ,10, 25 ,26 ,28 ,27 ,28 ,29 ,40 , 50 ,60]
        }*/





/*if ($i == count($surveyEvaluationsIds)-1){
				
				$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

				break;
			}

			$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";



/*var data = {

        labels: ["pregunta 1", "pregunta 2", "pregunta 3", "pregunta 4", "pregunta 5", "pregunta 6", 

                "pregunta 7","pregunta 8","pregunta 9","pregunta 10","pregunta 11","pregunta 12","pregunta 13",

                "pregunta 14","pregunta 15","pregunta 16","pregunta 17","pregunta 18","pregunta 19"

                ],
        datasets: [ {
          type: 'bar',
          label: 'Dataset 1',
          backgroundColor: "red",
          data: [65, 10, 80, 81, 56, 85, 40, 10, 25 ,10, 25 ,26 ,28 ,27 ,28 ,29 ,40 , 50 ,60]
        }, {
          type: 'bar',
          label: 'Dataset 3',
          backgroundColor: "blue",
          data: [65, 10, 80, 81, 56, 85, 40, 10, 25 ,10, 25 ,26 ,28 ,27 ,28 ,29 ,40 , 50 ,60]
        }



        ]
    };
*/






/**////////////////////////////////////////////////////////////////////////////////////////
		/***************/


		$SemesterId = 1; 

		$SubKnowledgeArea = SubKnowledgeArea::find(7);


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


		foreach($subjectsIds as $subjectId) {

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

		var_dump($sections);
		return "retonro";
		$sectionName = array_unique($sections);

		$sectionId = array_unique($sectionsIds);

















		/********************************/

		$KnowledgeArea = KnowledgeArea::find(3);

		$SemesterId = 1; 

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
		var_dump($sectionName);

		return "sections";

		
		




		function array_mesh($array, $SurveyEvaluationCount) {


			/*arrays  pertenecientes a cada evaluacion de encuesta*/

			$elements = array_chunk($array, ceil(count($array) / $SurveyEvaluationCount));

			
			for ($j = 0; $j< $SurveyEvaluationCount ; $j++) {


				$items = array_chunk($elements[$j], 5);

				  // Get the number of arguments being passed


		   		$numargs = count($items);//19

		   		/*echo "<pre>";
				var_dump($items);

				echo "</pre>";

				return "testg";*/


		   		   // Create an array to hold the combined data

				    $out = array();

				    // Loop through each of the arguments


				    for ($i = 0; $i < $numargs; $i++) {

				        $in = $items[$i]; // This will be equal to each array passed as an argument

				        // Loop through each of the arrays passed as arguments

				        foreach($in as $key => $value) {

				            // If the same key exists in the $out array

				            if(array_key_exists($key, $out)) {

				                // Sum the values of the common key

				                $sum = $in[$key] + $out[$key];

				                // Add the key => value pair to array $out

				                $out[$key] = $sum;

				            }else{
				                // Add to $out any key => value pairs in the $in array that did not have a match in $out

				                $out[$key] = $in[$key];

				            }

				        }

			    	}
				}

		    return $out;
		}


/* ****************************************/


function array_mesh2() {
	// Combine multiple associative arrays and sum the values for any common keys
	// The function can accept any number of arrays as arguments
	// The values must be numeric or the summed value will be 0
	
	// Get the number of arguments being passed
	$numargs = func_num_args();
	
	// Save the arguments to an array
	$arg_list = func_get_args();
	
	// Create an array to hold the combined data
	$out = array();

	// Loop through each of the arguments
	for ($i = 0; $i < $numargs; $i++) {
		$in = $arg_list[$i]; // This will be equal to each array passed as an argument

		// Loop through each of the arrays passed as arguments
		foreach($in as $key => $value) {
			// If the same key exists in the $out array
			if(array_key_exists($key, $out)) {
				// Sum the values of the common key
				$sum = $in[$key] + $out[$key];
				// Add the key => value pair to array $out
				$out[$key] = $sum;
			}else{
				// Add to $out any key => value pairs in the $in array that did not have a match in $out
				$out[$key] = $in[$key];
			}
		}
	}
	
	return $out;
}

















/** *////

		$TeacherId = 1;

		$SubjectId = 1;
		
		$SemesterId = 1;

		$SectionId = Section::where("name","01")->first()->id;

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$SurveyOptions = SurveyOption::all();

		/*$SurveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId);*/

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


		$SubjectProgrammingId = SubjectProgramming::where([
													    'teacher_id' =>  $TeacherId,
														'semester_id' => $SemesterId,
														'subject_id' => $SubjectId,
														'section_id' => $SectionId
													])->first()->id;

		/*id de las evaluaciones de encuesta del estudiante seleccionado*/

		$option1 = 0; 
		$option2 = 0;
		$option3 = 0;
		$option4 = 0;
		$option5 = 0;

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

		
 
 	/*opciones asociadas a las preguntas */

 	$option1Id = SurveyOption::where("description","1")->first()->id;
 	$option2Id = SurveyOption::where("description","2")->first()->id;
 	$option3Id = SurveyOption::where("description","3")->first()->id;
 	$option4Id = SurveyOption::where("description","4")->first()->id;
 	$option5Id = SurveyOption::where("description","5")->first()->id;

 	$countAll = array();

 	/*var_dump($surveyEvaluationsIds);

 	return "ids";*/

 	$SurveyEvaluationCount = count($surveyEvaluationsIds);


 	$querieConditions = "";

 	for ($i=0; $i<count($surveyEvaluationsIds); $i++){

			if ($i == count($surveyEvaluationsIds)-1){
				
				$querieConditions .= "survey_evaluation_id= $surveyEvaluationsIds[$i]";

				break;
			}

			$querieConditions .= "survey_evaluation_id = $surveyEvaluationsIds[$i] OR ";
		}


		

	

			foreach($SurveyOptions as $option) {
				
				foreach($surveyQuestionIds as $QuestionId) {

					$querie = "SELECT id FROM survey_answers WHERE survey_option_id = $option->id AND survey_question_id = $QuestionId AND". " (".  $querieConditions. ")";

					$results = DB::select( DB::raw($querie));


				/*	$SurveyAnswer = SurveyAnswer::where([
												'survey_evaluation_id' => $surveyEvaluation,
											    'survey_option_id' =>  $option->id,
											    'survey_question_id' => $QuestionId
											    
											])->count();*/
				
					array_push($countAll , count($results));

				}

			}

		

$items=array_chunk($countAll, 5);



$nums = array();
echo "<pre>";
var_dump($items);

echo "</pre>";


/************************/
/*var_dump(count($items));
/*return "aca";

*/
/*print_r(array_mesh($countAll,$SurveyEvaluationCount));*/

/*$options = array_mesh($countAll,$SurveyEvaluationCount);*/

/*var_dump($options);
*/




/*for ($i=0; $i<count($surveyEvaluationsIds); $i++ ) {

			$s= "->where('id',$surveyEvaluationsIds[$i])";

		}


		$Student = Student::.$s->first()->name;

		var_dump($Student);
return "cuentas";
*/
		

		$count = array();

		$SurveyAnswer = SurveyAnswer::where([
											    'survey_option_id' =>  "1000",
											    'survey_question_id' => "16",
											    'survey_evaluation_id' => "12"
											])->count();

		array_push($count , $SurveyAnswer);



		var_dump($count);

		return "aca";
		
	
	

		


/*
		foreach ($surveyEvaluationsIds as $surveyEvaluation){

			foreach($surveyQuestionIds as $QuestionId) {

				foreach($SurveyOptions as $option) {

					$SurveyAnswer = SurveyAnswer::where([
											    'survey_option_id' =>  $option->id,
											    'survey_question_id' => $QuestionId,
											    'survey_evaluation_id' => $surveyEvaluation
											])->first()->id;

				}

			}

		}*/


		

		$QuestionCount = SurveyAnswer::where([
											    'survey_question_id' =>  1,
											    'survey_evaluation_id' => 1,
											    'survey_option_id' => $option1Id
											])->get();


		$SurveyAnswer = SurveyAnswer::where("survey_evaluation_id","1")->count();


		
		var_dump($SurveyAnswer);

		return "count";
		


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
