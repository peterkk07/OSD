<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_activations', function (Blueprint $table) {
            
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_student')->unsigned();
            $table->foreign('id_student')->references('id')->on('students')->onDelete('cascade');
            $table->string('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('survey_activations');
    }
}
