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
use OSD\Student;
use OSD\SurveyEvaluation;




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
		$knowledgeAreas = KnowledgeArea::all();
		

		if( Auth::user() ){

            return view('internal.pickUserEvaluation')->with(compact('teachers','semesters','subjects','sections','knowledgeAreas'));

        }

        return redirect('/logout');
	}

	
	public function showChart(Request $request) {

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

		return response()->json(['options' => [$option1, $option2, $option3, $option4, $option5]]);

	}
	


}
