<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectProgrammingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_programmings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

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
        Schema::drop('subject_programmings');
    }
}
