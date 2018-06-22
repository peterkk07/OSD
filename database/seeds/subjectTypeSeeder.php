<?php

use Illuminate\Database\Seeder;
use OSD\SubjectType;

class subjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$typeSubject = array(
    		"Obligatoria",
    		"Electiva"
    	);

    	$countsubject = count($typeSubject);

    	for ($i = 0; $i<$countsubject; $i++) {

    		OSD\SubjectType::create([
            'name' => $typeSubject[$i]
        	]);
    	}
    }
}
