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
            $table->string('email')->unique();
            $table->string('answered')->default('0');
            $table->integer('count_evaluation')->default('0');
            $table->float('score', 10, 2);

            $table->integer('knowledge_area_id')->nullable()->unsigned();
            $table->foreign('knowledge_area_id')->references('id')->on('knowledge_areas')->onDelete('cascade');

            $table->integer('sub_knowledge_area_id')->nullable()->unsigned();
            $table->foreign('sub_knowledge_area_id')->references('id')->on('sub_knowledge_areas')->onDelete('cascade');


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
