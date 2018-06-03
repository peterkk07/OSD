<?php

use Illuminate\Database\Seeder;
use OSD\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$typeUsers = array(
    		"Estudiante",
    		"Profesor",
    		"Administrador",
    		"Coordinador",
    		"Director"
    	);

    	$countUsers = count($typeUsers);

    	for ($i = 0; $i<$countUsers; $i++) {

    		OSD\UserType::create([
            'description' => $typeUsers[$i]
        	]);
    	}
    }
}
