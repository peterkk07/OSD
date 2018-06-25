<?php

use Illuminate\Database\Seeder;
use OSD\SubjectProgramming;
use OSD\Student;


class StudentProgrammingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$subject_programming = SubjectProgramming::all();

        $student = Student::all();

        $count = count($student);
        

        for ($i=0; $i< $count; $i++) {

            for ($j=0; $j< 5; $j++) {

                $student[$i]->subject_programming()->attach(
                                    $subject_programming[$j]->id
                                    );
            }
        }
    }
}