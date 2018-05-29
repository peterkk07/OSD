<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();


            $table->integer('pregunta_id')->unsigned();
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');

            $table->integer('opcion_id')->unsigned();
            $table->foreign('opcion_id')->references('id')->on('opcions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('respuestas');
    }
}
