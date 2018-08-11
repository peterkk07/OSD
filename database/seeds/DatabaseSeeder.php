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
       
        $this->call('UserTypeSeeder');
        $this->call('subjectTypeSeeder');
        $this->call('AdminSeeder');

      $this->call('KnowledgeAreaSeeder');
        $this->call('TeacherSeeder');
        $this->call('SubjectSeeder');
        $this->call('StudentSeeder');
        $this->call('CoordinatorSeeder');
        $this->call('SectionsSeeder');
        $this->call('SemestersSeeder');
        $this->call('SubjectProgrammingSeeder');
        $this->call('StudentProgrammingSeeder');



        $this->call('DateSeeder');
        $this->call('SurveySeeder');
        $this->call('QuestionSeeder');
        $this->call('SemesterSurveySeeder');
        $this->call('SurveyEvaluationsSeeder');
        $this->call('SurveyOptionsSeeder');

        $this->call('SurveyQuestionSeeder');
        $this->call('SurveyAnswersSeeder');
        $this->call('SurveyVersionSeeder');
        
    }
}





