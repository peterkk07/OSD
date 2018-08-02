<?php

use Illuminate\Database\Seeder;
use OSD\Subject;
use OSD\Semester;
use OSD\Section;
use OSD\Teacher;
use OSD\Coordinator;

class SubjectProgrammingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$semesters = Semester::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $coordinators = Coordinator::all();

        $subject = Subject::all();

        $count = count($subject);
    
        for ($i=0; $i< $count; $i++) {

                for ($j=0; $j< 5; $j++) {

                $subject[$i]->semester()->attach(
                                    $semesters[$i]->id,
                                    [
                                    'section_id'=>$sections[$j]->id, 
                                    'teacher_id'=>$teachers[$j]->id,
                                    'coordinator_id'=>$coordinators[$j]->id,
                                                        ]);
            }
            
        }

    }
}
