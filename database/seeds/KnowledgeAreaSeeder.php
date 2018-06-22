<?php

use Illuminate\Database\Seeder;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$areas = array(
    		"Diseño",
    		"Calculo",
    		"Historia",
    		"Dibujo",
    	);

    	$count = count($areas);

    	for ($i = 0; $i<$count; $i++) {

    		OSD\KnowledgeArea::create([
            'name' => $areas[$i]
        	]);
    	}
    }
}
