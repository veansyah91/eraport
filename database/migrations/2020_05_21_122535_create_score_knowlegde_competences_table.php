<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreKnowlegdeCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_knowlegde_competences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('knowledge_base_competence_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('score_ratio_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            $table->foreign('knowledge_base_competence_id')->references('id')->on('knowledge_base_competences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('score_ratio_id')->references('id')->on('score_ratios')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_knowlegde_competences');
    }
}
