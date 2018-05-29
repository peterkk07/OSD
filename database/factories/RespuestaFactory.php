<?php

use OSD\Pregunta;
use OSD\Opcion;




$opciones =OSD\Opcion::all();

OSD\Pregunta::all()->each(function ($pregunta) use ($opciones) { 
    $pregunta->opcion()->attach(
        $opciones->random(rand(1, 5))->pluck('id')->toArray()
    ); 
});