<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectLevelKnowledgeBaseCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_base_competences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('level_subject_id')->unsigned();
            $table->string('pengetahuan_kompetensi_dasar');

            $table->foreign('level_subject_id')->references('id')->on('level_subjects')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('subject_level_knowledge_base_competences');
    }
}
