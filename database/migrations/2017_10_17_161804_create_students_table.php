<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ci')->unique();

            $table->integer('knowledge_area_id')->unsigned();
            $table->foreign('knowledge_area_id')->references('id')->on('knowledge_areas')->onDelete('cascade');

            $table->integer('student_programming_id')->unsigned();
            $table->foreign('student_programming_id')->references('id')->on('student_programmings')->onDelete('cascade');


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
        Schema::drop('students');
    }
}
