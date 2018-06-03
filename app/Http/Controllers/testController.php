<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;

use OSD\Http\Requests;
use OSD\Respuesta;
use OSD\Pregunta;
use OSD\Opcion;
use DB;
use \Datetime;


class testController extends Controller
{
    
	public function index() {


		$preguntas =Pregunta::orderBy('id')->get();
		$opciones=Opcion::orderBy('id')->get();

		return view('test')->with(compact('preguntas'))->with(compact('opciones'));


	}

	public function selected(Request $request )  {


		$opcion = $request['opcion'];
		$pregunta_id = $request['pregunta'];

		$opciones= Opcion::where("description",$opcion)->pluck("description");

		$preguntas = Pregunta::whereHas('opcion', function ($query) use ($opcion) {
        $query->where('description',"=",$opcion);
	    })->where("id",$pregunta_id)->pluck("description");

		$numero_respuestas = count($preguntas);
	
		 return view ('test-count',['cantidad' => $numero_respuestas])->with(compact('opciones'));;

	}

}
