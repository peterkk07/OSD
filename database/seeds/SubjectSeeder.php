<?php

use Illuminate\Database\Seeder;
use OSD\SubjectType;
use OSD\Subject;
use OSD\KnowledgeArea;

class SubjectSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	/*materias para cada area de conocimiento*/
    	$calculo = array(
    		"Matematicas 1",
    		"Matematicas 2",
    		"Matematicas 3"
    	);

    	$cod_calculo = array(
    		"001",
    		"002",
    		"003"
    	);


    	$areaCalculo= KnowledgeArea::where("name","Calculo")->first()->id;
    	/*****************************************/

    /*	$historia = array(
    		"Historia 1",
    		"Historia 2",
    		"Historia 3"
    	);

    	$cod_historia = array(
    		"004",
    		"005",
    		"006"
    	);


    	$areaHistoria= KnowledgeArea::where("name","Historia")->first()->id;*/
    	/*****************************************/

    	$diseno = array(
    		"Diseño 1",
    		"Diseño 2",
    		"Diseño 3"
    	);

    	$cod_diseno = array(
    		"007",
    		"008",
    		"009"
    	);

    	$areaDiseno= KnowledgeArea::where("name","Diseño")->first()->id;
		/*****************************************/
    	
    	$dibujo = array(
    		"Dibujo 1",
    		"Dibujo 2",
    		"Dibujo 3"
    	);

    	$cod_dibujo = array(
    		"010",
    		"011",
    		"012"
    	);

    	$areaDibujo= KnowledgeArea::where("name","Dibujo")->first()->id;
		/*****************************************/


		$obligatoria= SubjectType::where("name","Obligatoria")->first()->id;

    	/*Materias de calculo*/
    	$count = count($calculo);

    	for ($i = 0; $i<$count; $i++) {

    		$subject = Subject::create([
            'name' => $calculo[$i],
            'semester' => $i+1,
            'cod' => $cod_calculo[$i]
        	]);

	        $subject->type_subject()->associate($obligatoria);
	        $subject->knowledge_area()->associate($areaCalculo);
	        $subject->save();
    	}


    	/*Materias de Historia*/
    	/*$count = count($historia);

    	for ($i = 0; $i<$count; $i++) {

    		$subject = Subject::create([
            'name' => $historia[$i],
            'semester' => $i+1,
            'cod' => $cod_historia[$i]
        	]);

	        $subject->type_subject()->associate($obligatoria);
	        $subject->knowledge_area()->associate($areaHistoria);
	        $subject->save();
    	}*/


    	/*Materias de Diseño*/

    	$count = count($diseno);

    	for ($i = 0; $i<$count; $i++) {

    		$subject = Subject::create([
            'name' => $diseno[$i],
            'semester' => $i+1,
            'cod' => $cod_diseno[$i]
        	]);

	        $subject->type_subject()->associate($obligatoria);
	        $subject->knowledge_area()->associate($areaDiseno);
	        $subject->save();
    	}


    	/*Materias de Dibujo*/

    	$count = count($dibujo);

    	for ($i = 0; $i<$count; $i++) {

    		$subject = Subject::create([
            'name' => $dibujo[$i],
            'semester' => $i+1,
            'cod' => $cod_dibujo[$i]
        	]);

	        $subject->type_subject()->associate($obligatoria);
	        $subject->knowledge_area()->associate($areaDibujo);
	        $subject->save();
    	}
    	
    }
}
