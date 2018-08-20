<?php

use Illuminate\Database\Seeder;
use OSD\Student;
use OSD\SemesterSurvey;
use OSD\StudentProgramming;
use OSD\Dates;

class SurveyEvaluationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		$students = Student::all();
        $SemesterSurvey = SemesterSurvey::where("status",1)->first();
        $StudentProgramming = StudentProgramming::all();
        $Dates = Dates::all();
        $i= 0;


        foreach ($students as $data) {

        $student = Student::find($data->id);

            foreach($student->subject_programming as $data){

                $student
                ->semester_survey()
                ->attach(
                     $SemesterSurvey->id,
                    [
                        'student_programming_id'=>$data->pivot->id, 
                        'date'=>$Dates[0]->start_date,
                        'description'=>"Descripcion y observaciones de la encuesta",
                    ]);

            }
                    
        }

    }
}
