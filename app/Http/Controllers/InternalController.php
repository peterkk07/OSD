<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;
use OSD\Http\Requests;
use Illuminate\Support\Facades\Auth;
use OSD\Teacher;
use OSD\Semester;
use OSD\Subject;
use OSD\Section;
use OSD\KnowledgeArea;
use OSD\SubKnowledgeArea;
use OSD\Student;
use OSD\SurveyEvaluation;
use OSD\SubjectProgramming;



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

	
	public function showChart(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$TeacherId = $request["teacher"];

		$SubjectId = $request["subject"];
		
		$Semester = $request["semester"];



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

		return response()->json(['options' => [$option1, $option2, $option3, $option4, $option5]]);

	}

/*actualizar los campos de select , según el área de conocimiento proporcionada*/
	
	public function updateKnowledgeArea(Request $request) {

		$KnowledgeArea = KnowledgeArea::find($request["knowledgeArea"]);

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
		$teachersIds = array();

		foreach ($KnowledgeArea->subject as $data){

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
		
		return response()->json(
								['subKnowledgeAreas' => $SubKnowledgeAreaNames,
								 'SubKnowledgeAreaIds' => $SubKnowledgeAreaIds,
								 'subjectNames' => $subjectNames,
								 'subjectsIds' => $subjectsIds,
								 'teachersNames' => $teachersNames,
								 'teachersIds' => $teachersIds

								]

								);

	}
	
	/*Actualizar sub area de conocimiento 	*/

	public function updateSubKnowledgeArea(Request $request) {


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
		
		return response()->json(
								[
								 'subjectNames' => $subjectNames,
								 'subjectsIds' => $subjectsIds,
								 'teachersNames' => $teachersNames,
								 'teachersIds' => $teachersIds

								]

								);

	}

	/*Actualizar al seleccionar materias*/

	public function updateSubject(Request $request) {

		$Subject = Subject::find($request["Subject"]);

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

		
		return response()->json(
								[
								 'knowledgeAreaId' => $knowledgeAreaId,
								 'knowledgeAreaName' => $knowledgeAreaName,
								 'subknowledgeAreaId' => $subknowledgeAreaId,
								 'subknowledgeAreaName' => $subknowledgeAreaName,
								 'teachersId' => $teachersId,
								 'teachersNames' => $teachersNames,
								]

								

								);
	}



	public function updateTeacher(Request $request) {


		$TeacherId = $request["TeacherId"];

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

		
		return response()->json(
								[
								 'knowledgeAreaIds' => $knowledgeAreaIds,
								 'knowledgeAreaNames' => $knowledgeAreaNames,
								 'subKnowledgeAreaIds' => $subKnowledgeAreaIds,
								 'subKnowledgeAreaNames' => $subKnowledgeAreaNames,
								 'subjectNames' => $SubjectNames,
								 'subjectIds' => $SubjectIds,
								]

								

								);
	}

	


}
