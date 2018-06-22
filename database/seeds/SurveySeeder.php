<?php

use Illuminate\Database\Seeder;
use OSD\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surveys = array(
            "Encuesta piloto","Encuesta 2018","Encuesta Evaluadora",
            "Encuesta de prueba","Encuesta definitiva", "Encuesta nueva",
            "Encuesta para tomar medidas", "Encuesta buscadora", "Encuesta arquitectura",
            "Encuesta Diseño"
        );

        $count = count($surveys);

        for ($i = 0; $i<$count; $i++) {

            $survey = Survey::create([
            'name' => $surveys[$i],
            ]);
        }
    }
}
