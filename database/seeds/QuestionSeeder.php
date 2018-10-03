<?php

use Illuminate\Database\Seeder;
use OSD\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = array(
    		'Expuso con claridad el programa de la asignatura y el plan de evaluación al comenzar el período académico',
        	'Desmuestra dominio de la asignatura',
        	'Cumple su horario de clase (llegada, salida)',
        	'Presenta coherentemente sus exposiciones, presentaciones, demostraciones y comentarios',
        	'Fomenta la participación del alumno',
        	'Promueve actividades que facilitan el aprendizaje de la asignatura',
        	'Recomienda bibliografía o materiales que son de ayuda para comprender la asignatura',
        	'Mantiene un trato respetuoso con los estudiantes',
        	'Valora las iniciativas del estudiante',
        	'Utiliza materiales didácticos en soporte convencional y/o tecnológico',
        	'Es tolerante a la divergencia y a la crítica',
        	'Ofrece posibilidades de consulta a los estudiantes',
        	'Respeta los acuerdos y compromisos establecidos con los estudiantes',
        	'Informa oportunamente a los estudiantes sobre sus progresos y dificultades',
        	'Utiliza un sistema de evaluación que se ajusta a los contenidos',
        	'Plantea actividades de recuperación',
        	'Da a conocer resultados de evaluaciones en los lapsos acordados con los estudiantes',
        	'Los contenidos impartidos se corresponden con los objetivos de la asignatura',
        	'Los contenidos son actualizados'
    	);


    	$count = count($questions);

			for ($i = 0; $i < $count; $i++) {

	    		$Question = Question::create([
	            'description' => $questions[$i],
	            ]);
 	
		}

    }
}
