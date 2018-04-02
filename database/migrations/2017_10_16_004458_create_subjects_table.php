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

            $table->integer('subject_type_id')->unsigned();
            $table->foreign('subject_type_id')->references('id')->on('subject_types')->onDelete('cascade');

            $table->integer('coordinator_id')->unsigned();
            $table->foreign('coordinator_id')->references('id')->on('coordinators')->onDelete('cascade');
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
