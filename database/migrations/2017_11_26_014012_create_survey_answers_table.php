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

            $table->integer('survey_options_id')->unsigned();
            $table->foreign('survey_options_id')->references('id')->on('survey_options')->onDelete('cascade');

            $table->integer('survey_answers_id')->unsigned();
            $table->foreign('survey_answers_id')->references('id')->on('survey_answers')->onDelete('cascade');

            $table->integer('survey_evaluation_id')->unsigned();
            $table->foreign('survey_evaluation_id')->references('id')->on('survey_evaluations')->onDelete('cascade');


            $table->increments('id');
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
