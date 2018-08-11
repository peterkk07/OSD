<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubKnowledgeAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_knowledge_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();

            $table->integer('knowledge_area_id')->nullable()->unsigned();
            $table->foreign('knowledge_area_id')->references('id')->on('knowledge_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sub_knowledge_areas');
    }
}
