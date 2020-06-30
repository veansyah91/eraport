<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScorePracticeCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_practice_competences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('practice_base_competence_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->string('praktek')->nullable();
            $table->string('produk')->nullable();
            $table->string('proyek')->nullable();
            $table->timestamps();

            $table->foreign('practice_base_competence_id')->references('id')->on('practice_base_competences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_practice_competences');
    }
}
