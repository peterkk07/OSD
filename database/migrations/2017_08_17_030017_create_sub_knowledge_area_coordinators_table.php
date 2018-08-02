<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubKnowledgeAreaCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_knowledge_area_coordinators', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('ci');
                $table->string('email');
                
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
        Schema::drop('sub_knowledge_area_coordinators');
    }
}
