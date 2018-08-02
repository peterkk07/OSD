<?php

use Illuminate\Database\Seeder;
use OSD\Semester;
use OSD\Survey;
use OSD\Dates;


class SemesterSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          
        $survey = Survey::all();
		$semesters = Semester::all();
        $start_date = Dates::all("start_date");
        $end_date = Dates::all("end_date");

        $count = count($semesters);
      
    
        for ($i=0; $i< $count; $i++) {

            $survey[$i]->semester()->attach(
                			$semesters[$i]->id,['start_date'=>$start_date[$i]->start_date,
                   				'end_date'=>$end_date[$i]->end_date,
                                'status' => 1]
                          	);
            
            
        }
    }
}



