<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('semester');
            $table->timestamps();

            $table->integer('knowledge_area_id')->unsigned();
            $table->foreign('knowledge_area_id')->references('id')->on('knowledge_areas')->onDelete('cascade');

            $table->integer('type_subject_id')->unsigned();
            $table->foreign('type_subject_id')->references('id')->on('type_subjects')->onDelete('cascade');

            $table->integer('subject_programming_id')->unsigned();
            $table->foreign('subject_programming_id')->references('id')->on('subject_programmings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjects');
    }
}
