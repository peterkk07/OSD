<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;
use OSD\Http\Requests;
use Illuminate\Support\Facades\Auth;
use OSD\Teacher;
use OSD\Coordinator;
use OSD\SubKnowledgeAreaCoordinator;
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
use PDF;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


	    public function reportTeacherForm() {

	    	$teachers = Teacher::orderBy('name')->get();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			$subKnowledgeAreas = SubKnowledgeArea::all();
			$knowledgeAreas = KnowledgeArea::all();

			if( Auth::user() ){

	            return view('report.reportTeacherForm')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

	        }

	        return redirect('/logout');
	    }


	    public function reportAreaForm() {

	    	if( Auth::user()->type_user->description == 'Director' ){

				$teachers = Teacher::all();
				$semesters = Semester::all();
				$subjects = Subject::all();
				$sections = Section::all();
				$subKnowledgeAreas = SubKnowledgeArea::all();
				$knowledgeAreas = KnowledgeArea::all();

	            return view('report.reportAreaForm')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

	        }

	        if( Auth::user()->type_user->description == 'Coordinador_areas' ){

				$semesters = Semester::all();
				
				$sections = Section::all();
				
				$CoordinatorId = Coordinator::where('ci',Auth::user()->ci)->first()->id;

				$Coordinator = Coordinator::find($CoordinatorId);

				$subjects = Subject::where('knowledge_area_id',$Coordinator->knowledge_area->id)->get();

				$knowledgeAreas = KnowledgeArea::where('id',$Coordinator->knowledge_area->id)->get();


	            return view('report.reportAreaForm')->with(compact('semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

	        }

	        return redirect('/logout');

	    }


	    public function reportSubAreaForm() {

			if( Auth::user()->type_user->description == 'Director' ){

			$teachers = Teacher::all();
			$semesters = Semester::all();
			$subjects = Subject::all();
			$sections = Section::all();
			$subKnowledgeAreas = SubKnowledgeArea::all();
		

            return view('report.reportSubAreaForm')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

        	}

	         if( Auth::user()->type_user->description == 'Coordinador_areas' ){

				$teachers = Teacher::all();
				$semesters = Semester::all();
				$subjects = Subject::all();
				$sections = Section::all();

				$Coordinator = Coordinator::where('ci',Auth::user()->ci)->first();

				$knowledgeArea = $Coordinator->knowledge_area;

				$subKnowledgeAreas = SubKnowledgeArea::where('knowledge_area_id',$knowledgeArea->id)->get();

				
				$countSubAreas = count($subKnowledgeAreas);

				if ($countSubAreas==0)
					return view('internal.emptySubArea');


	            return view('report.reportSubAreaForm')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

	        }


	        if( Auth::user()->type_user->description == 'Coordinador_sub_areas' ){

				$semesters = Semester::all();
				
				$sections = Section::all();

				$CoordinatorId = SubKnowledgeAreaCoordinator::where('ci',Auth::user()->ci)->first()->id;

				$Coordinator = SubKnowledgeAreaCoordinator::find($CoordinatorId);

				$subjects = Subject::where('sub_knowledge_area_id',$Coordinator->sub_knowledge_area->id)->get();

				$subKnowledgeAreas = SubKnowledgeArea::where('id',$Coordinator->sub_knowledge_area->id)->get();

				
				$countSubAreas = count($subKnowledgeAreas);

				if ($countSubAreas==0)
					return view('internal.emptySubArea');


	            return view('report.reportSubAreaForm')->with(compact('semesters','subjects','sections','knowledgeAreas','subKnowledgeAreas'));

	        }


        return redirect('/logout');
	}




    	public function createReportTeacher(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/


		$TeacherId = $request["teacher"];

		$Teacher = Teacher::find($TeacherId);

		$TeacherName = $Teacher->name;

		$SemesterId = $request["semester"];

		$SemesterNames = Semester::find($SemesterId);

		$SemesterName = $SemesterNames->name;

		$KnowledgeArea = $request["knowledgeArea"];

		$SubKnowledgeArea = $request["subKnowledgeArea"];

		$Subject = SubjectProgramming::where('teacher_id',$TeacherId)->first();

		$sectionName = Section::where('id',$Subject->section_id)->first()->name;


		if ($Subject->knowledgeArea!=NULL){

			$area = $Subject->knowledgeArea->name;
			$area_score = $Subject->knowledgeArea->score;
		}

		if ($Subject->sub_knowledgeArea!=NULL){

			$area = $Subject->sub_knowledgeArea->name;
			$area_score = $Subject->sub_knowledgeArea->score;	
		}



		if($Subject == NULL)
			return redirect()->back()->with('error', 'Este profesor no tiene materias asignadas en este período lectivo');

		$SubjectId = $Subject->subject_id;

		$SubjectNames = Subject::find($SubjectId);

		$SubjectName = $SubjectNames->name;

		$SectionId = $Subject->section_id;



		if ( ($KnowledgeArea == NULL) && ($SubKnowledgeArea == NULL) ||

			 ($KnowledgeArea == NULL) && ($SubKnowledgeArea == "") ||

			 ($KnowledgeArea == "") && ($SubKnowledgeArea == NULL) ||

			 ($KnowledgeArea == "") && ($SubKnowledgeArea == "")	


			){

			return redirect()->back()->with('error', 'Asegurese que ha introducido el Área de Conocimiento o Sub Área de Conocimiento');
		}
		
		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$surveyQuestionNames = SurveyQuestion::where("survey_id",$surveyId)->get();

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


		$questionsTables = array();

			foreach($surveyQuestionNames as $questions) {
				
				array_push($questionsTables ,$questions->description);
			}


			switch ($TeacherId) {
				case '1':
					$items = ['4.5','4.1','4.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','5','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '2':
					$items = ['1.5','4.2','4.4','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '3':
					$items = ['3.5','1.1','2.7','4.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '4':
					$items = ['4.5','1.1','4.7','3.5','3.36','4.8',
							'2.99','1.55','1.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '5':
					$items = ['5','4.1','4.7','3.5','3.36','4.8',
							'9.99','1.55','3.5','2.5','3.88','4.11',
							'1.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '6':
					$items = ['3.5','2.1','2.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '7':
					$items = ['1.5','1.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '8':
					$items = ['1.5','1.1','2.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','3.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '9':
					$items = ['1.5','4.1','2.7','3.5','3.36','4.8',
							'3.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '10':
					$items = ['3.5','3.1','4.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '11':
					$items = ['3.5','2.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '12':
					$items = ['2.5','1.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '13':
					$items = ['2.5','3.1','1.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '14':
					$items = ['3.5','3.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '15':
					$items = ['2.5','2.1','2.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '17':
					$items = ['1.5','2.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;

				case '18':
					$items = ['3.5','2.1','3.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;
				
				default:
					$items = ['3.5','2.1','1.7','3.5','3.36','4.8',
							'2.99','1.55','3.5','2.5','3.88','4.11',
							'4.12','4.70','3.99','1.12','4.12',
							'3.12','1.12'];
					break;
			}

			$promTeacher = round ( (array_sum($items)/count($items)),2) ;

			$area_score = 4.22;
			
			/*Generar reporte*/

			$pdf = PDF::loadView('report.reportTeacher',array(
												'items' => $items,
												'questionsTables' => $questionsTables,
												'SubjectName' => $SubjectName,
												'CountStudentsAnswered' =>$CountStudentsAnswered,
												'CountStudentPercentage' =>$CountStudentPercentage,
												'TeacherName' => $TeacherName,
												'SemesterName' =>$SemesterName,
												'promTeacher' =>$promTeacher,
												'sectionName' =>$sectionName,
		
												'area_score' => $area_score

			 													));

		      $pdf->setOption('enable-javascript', true);
		      $pdf->setOption('javascript-delay', 5000);
		      $pdf->setOption('enable-smart-shrinking', true);
		      $pdf->setOption('no-stop-slow-scripts', true);
		      
		      return $pdf->download('Reporte.pdf');


			/*return view('report.reportTeacher')->with(compact('items','questionsTables','SubjectName','CountStudentsAnswered','CountStudentPercentage','SubjectName','TeacherName','SemesterName','promTeacher','sectionName','area','area_score'));*/


		}




		public function createReportArea(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$SemesterId = $request["semester"];

		$SemesterNames = Semester::find($SemesterId);

		$SemesterName = $SemesterNames->name;

		$KnowledgeAreaId = $request["knowledgeArea"];

		$KnowledgeArea = KnowledgeArea::find($KnowledgeAreaId );

		$CoordinatorName = Coordinator::where('knowledge_area_id',$KnowledgeAreaId)->first()->name;

		$AreaName = $KnowledgeArea->name;

		$Subjects = Subject::where('knowledge_area_id',$KnowledgeAreaId)->pluck("id");

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$surveyQuestionNames = SurveyQuestion::where("survey_id",$surveyId)->get();

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;


		
		if (count($Subjects)==0 ) {
			return redirect()->back()->with('error', 'El Área de Conocimiento seleccionada no posee evaluaciones en este período lectivo');
		}

		$teacherNames = array();
		$teacherSection = array();
		$SubjectNames = array();
		$TeacherScore = array();

		
		foreach($Subjects as $SubjectId) {

			$SubjectProgrammings = SubjectProgramming::where([
									    'semester_id' =>  $SemesterId,
									    'subject_id' => $SubjectId
										])->get();


			foreach ($SubjectProgrammings as $programming) {
				
				$TeacherName = Teacher::where('id',$programming->teacher_id)->first();

				if($TeacherName ==NULL)
					continue;

				$SectionName= Section::where('id',$programming->section_id)->first()->name;

				$teacherSubject = Subject::where('id',$programming->subject_id)->first()->name;

				
				array_push($teacherNames, $TeacherName->name);
				array_push($TeacherScore, $TeacherName->score);
				array_push($teacherSection, $SectionName);
				array_push($SubjectNames, $teacherSubject);

			}
		}


		if (count($teacherNames)==0 ) {
			return redirect()->back()->with('error', 'El Área de Conocimiento seleccionada no posee evaluaciones en este período lectivo');
		}

		$TeacherId =1;
		$SemesterId=1;
		$studentsIds = Student::whereHas('subject_programming', function($q) use ($TeacherId,$SemesterId,$SubjectId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $SemesterId,
		    'subject_id' => $SubjectId,
		   

		]);})->pluck("id");

		/*Cantidad de usuarios pertenecientes a esta materia*/


		$studentAnswered = Student::where('answered','1')->pluck("id");
	
		$CountStudentsSubject = count($studentAnswered);

		$CountStudentsAnswered = count($studentAnswered);

		$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";


		$questionsTables = array();

			foreach($surveyQuestionNames as $questions) {
				
				array_push($questionsTables ,$questions->description);
			}

				
			$teacherNames = array_unique($teacherNames);
			$TeacherScore = array_unique($TeacherScore);
			$SubjectNames = array_unique($SubjectNames);
			
			$area_score = $KnowledgeArea->score;

			$knowledgeAreasScores = array();

			$knowledgeAreasScores = array();
			
			$AnotherAreasNames = array();

			$AnotherAreaScores = KnowledgeArea::where('id','!=',$KnowledgeAreaId)->get();


			foreach ($AnotherAreaScores as $AreaScore){

				array_push($knowledgeAreasScores, $AreaScore->score);
				array_push($AnotherAreasNames, $AreaScore->name);
			}

		/*	$areasSum = array_sum($knowledgeAreasScores);

			$areasProm = $areasSum/count($AreaScores);*/


			$teacherSum =  array_sum($TeacherScore); 

			$teacherProm =  round($teacherSum/count($TeacherScore),2 );

			/*Generar reporte*/

			return view('report.reportArea')->with(compact('items','questionsTables','SubjectNames','CountStudentsAnswered','CountStudentPercentage','teacherNames','SemesterName','TeacherScore','sectionName','area_score','AreaName','CoordinatorName','AnotherAreasNames','knowledgeAreasScores','teacherSection','teacherProm'));

/*
			$pdf = PDF::loadView('report.reportArea',array(
												
												
												'SubjectNames' => $SubjectNames,
												'CountStudentsAnswered' =>$CountStudentsAnswered,
												'CountStudentPercentage' =>$CountStudentPercentage,
												'teacherNames' => $teacherNames,
												'SemesterName' =>$SemesterName,
												'TeacherScore' =>$TeacherScore,
												
												'area_score' =>$area_score,
												'AreaName' =>$AreaName,
												'CoordinatorName' =>$CoordinatorName,
												'AnotherAreasNames' =>$AnotherAreasNames,
												'knowledgeAreasScores' =>$knowledgeAreasScores,
												'teacherSection' =>$teacherSection,
												'teacherProm' =>$teacherProm
			 									));

		      $pdf->setOption('enable-javascript', true);
		      $pdf->setOption('javascript-delay', 5000);
		      $pdf->setOption('enable-smart-shrinking', true);
		      $pdf->setOption('no-stop-slow-scripts', true);
		      
		      return $pdf->download('Reporte.pdf');*/


		}


		public function createReportSubArea(Request $request) {

		/*todos los estudiantes que tienen programacion de materia con este profesor*/

		$SemesterId = $request["semester"];

		$SemesterNames = Semester::find($SemesterId);

		$SemesterName = $SemesterNames->name;

		$SubKnowledgeAreaId = $request["subknowledgeArea"];


		$SubKnowledgeArea = SubKnowledgeArea::find($SubKnowledgeAreaId );

		$CoordinatorName = SubKnowledgeAreaCoordinator::where('sub_knowledge_area_id',$SubKnowledgeAreaId)->first()->name;

		$AreaName = $SubKnowledgeArea->name;

		$Subjects = Subject::where('sub_knowledge_area_id',$SubKnowledgeAreaId)->pluck("id");

		$surveyId = SemesterSurvey::where("semester_id",$SemesterId )->first()->id;

		$surveyQuestionIds = SurveyQuestion::where("survey_id",$surveyId)->pluck("id");

		$surveyQuestionNames = SurveyQuestion::where("survey_id",$surveyId)->get();

		$semesterSurveyId = SemesterSurvey::where([
									    'semester_id' =>  $SemesterId,
									    'survey_id' => $surveyId
										])->first()->id;


		
		if (count($Subjects)==0 ) {
			return redirect()->back()->with('error', 'El Área de Conocimiento seleccionada no posee evaluaciones en este período lectivo');
		}

		$teacherNames = array();
		$teacherSection = array();
		$SubjectNames = array();
		$TeacherScore = array();

		
		foreach($Subjects as $SubjectId) {

			$SubjectProgrammings = SubjectProgramming::where([
									    'semester_id' =>  $SemesterId,
									    'subject_id' => $SubjectId
										])->get();


			foreach ($SubjectProgrammings as $programming) {
				
				$TeacherName = Teacher::where('id',$programming->teacher_id)->first();

				if($TeacherName ==NULL)
					continue;

				$SectionName= Section::where('id',$programming->section_id)->first()->name;

				$teacherSubject = Subject::where('id',$programming->subject_id)->first()->name;

				
				array_push($teacherNames, $TeacherName->name);
				array_push($TeacherScore, $TeacherName->score);
				array_push($teacherSection, $SectionName);
				array_push($SubjectNames, $teacherSubject);

			}
		}

		if (count($teacherNames)==0 ) {
			return redirect()->back()->with('error', 'El Sub Área de Conocimiento seleccionada no posee evaluaciones en este período lectivo');
		}


		$TeacherId =1;
		$SemesterId=1;
		$studentsIds = Student::whereHas('subject_programming', function($q) use ($TeacherId,$SemesterId,$SubjectId) {
        
        $q->where([
		    'teacher_id' =>  $TeacherId,
		    'semester_id' => $SemesterId,
		    'subject_id' => $SubjectId,
		   

		]);})->pluck("id");

		/*Cantidad de usuarios pertenecientes a esta materia*/


		$studentAnswered = Student::where('answered','1')->pluck("id");
	
		$CountStudentsSubject = count($studentAnswered);

		$CountStudentsAnswered = count($studentAnswered);

		$CountStudentPercentage = round( ($CountStudentsAnswered *100)/$CountStudentsSubject,2)."%";


		$questionsTables = array();

			foreach($surveyQuestionNames as $questions) {
				
				array_push($questionsTables ,$questions->description);
			}

				
			$teacherNames = array_unique($teacherNames);
			$TeacherScore = array_unique($TeacherScore);
			$SubjectNames = array_unique($SubjectNames);
			
			$area_score = $SubKnowledgeArea->score;

			$SubknowledgeAreasScores = array();

		
			$AnotherAreasNames = array();

			$AnotherAreaScores = SubKnowledgeArea::where('id','!=',$SubKnowledgeAreaId)->get();


			foreach ($AnotherAreaScores as $AreaScore){

				array_push($SubknowledgeAreasScores, $AreaScore->score);
				array_push($AnotherAreasNames, $AreaScore->name);
			}

		/*	$areasSum = array_sum($knowledgeAreasScores);

			$areasProm = $areasSum/count($AreaScores);*/


			$teacherSum =  array_sum($TeacherScore); 

			$teacherProm = round($teacherSum/count($TeacherScore),2 );


			/*Generar reporte*/

			/*return view('report.reportSubArea')->with(compact('items','questionsTables','SubjectNames','CountStudentsAnswered','CountStudentPercentage','teacherNames','SemesterName','TeacherScore','sectionName','area_score','AreaName','CoordinatorName','AnotherAreasNames','SubknowledgeAreasScores','teacherSection','teacherProm'));*/


			$pdf = PDF::loadView('report.reportSubArea',array(
											
												
												'SubjectNames' => $SubjectNames,
												'CountStudentsAnswered' =>$CountStudentsAnswered,
												'CountStudentPercentage' =>$CountStudentPercentage,
												'teacherNames' => $teacherNames,
												'SemesterName' =>$SemesterName,
												'TeacherScore' =>$TeacherScore,
												
												'area_score' => $area_score,
												'AreaName' => $AreaName,
												'CoordinatorName' => $CoordinatorName,
												'AnotherAreasNames' => $AnotherAreasNames,
												'SubknowledgeAreasScores' => $SubknowledgeAreasScores,
												'teacherSection' => $teacherSection,
												'teacherProm' => $teacherProm,

			 													));

		      $pdf->setOption('enable-javascript', true);
		      $pdf->setOption('javascript-delay', 5000);
		      $pdf->setOption('enable-smart-shrinking', true);
		      $pdf->setOption('no-stop-slow-scripts', true);
		      
		      return $pdf->download('Reporte.pdf');


			


		}



}
