<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_evaluation');
            $table->date('comments');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('semester_survey_id')->unsigned();
            $table->foreign('semester_survey_id')->references('id')->on('semester_surveys')->onDelete('cascade');

            $table->integer('student_program_id')->unsigned();
            $table->foreign('student_program_id')->references('id')->on('survey_student_programs')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('survey_evaluations');
    }
}
