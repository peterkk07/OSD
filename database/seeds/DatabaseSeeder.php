<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('KnowledgeAreaSeeder');
        $this->call('SurveyOptionsSeeder');
        $this->call('TeacherSeeder');
    }
}
