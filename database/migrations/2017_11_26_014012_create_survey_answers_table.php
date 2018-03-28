<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->increments('id');
           
            $table->integer('survey_option_id')->unsigned();
            $table->foreign('survey_option_id')->references('id')->on('survey_options')->onDelete('cascade');

            $table->integer('survey_answer_id')->unsigned();
            $table->foreign('survey_answer_id')->references('id')->on('survey_answers')->onDelete('cascade');

            $table->integer('survey_evaluation_id')->unsigned();
            $table->foreign('survey_evaluation_id')->references('id')->on('survey_evaluations')->onDelete('cascade');

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
        Schema::drop('survey_answers');
    }
}
