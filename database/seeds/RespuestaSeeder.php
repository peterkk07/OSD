<?php

use Illuminate\Database\Seeder;
use OSD\Pregunta;
use OSD\Opcion;

class RespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$opciones =OSD\Opcion::all();

		OSD\Pregunta::all()->each(function ($pregunta) use ($opciones) { 
		    
            for ($i= 0;  $i<15; $i++) {
                $pregunta->opcion()->saveMany($opciones);
            }
           
		});

    }
}
