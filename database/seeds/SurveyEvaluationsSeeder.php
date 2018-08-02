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
        
		$Student = Student::all();
        $SemesterSurvey = SemesterSurvey::where("status",1)->first();
        $StudentProgramming = StudentProgramming::all();
        $Dates = Dates::all();


        $count = count($Student);
    
        for ($i=0; $i< $count; $i++) {

            $Student[$i]
            ->semester_survey()
            ->attach(
                     $SemesterSurvey->id,
                    [
	                    'student_programming_id'=>$StudentProgramming[$i]->id, 
	                    'date'=>$Dates[$i]->start_date,
	                    'description'=>"Descripcion y observaciones de la encuesta",
                    ]);
            
        }

    }
}
