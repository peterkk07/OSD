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
		$subject_programming =SubjectProgramming::all();

		OSD\Student::all()->each(function ($student) use ($subject_programming) { 
		    
            $student->subject_programming()->saveMany($subject_programming);
            
		});

    }
}