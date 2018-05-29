<?php

use Illuminate\Database\Seeder;

class preguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OSD\Pregunta::class, 20)->create();
    }
}
