<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('knowledge_base_competence_id');
            $table->unsignedBigInteger('score_ratio_id');
            $table->string('image')->nullable();
            $table->string('question');
            $table->string('answer_type');
            $table->integer('number_of_answers')->nullable();
            $table->string('answer')->nullable();
            $table->string('number')->nullable();
            $table->timestamps();

            $table->foreign('score_ratio_id')->references('id')->on('score_ratios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('knowledge_base_competence_id')->references('id')->on('knowledge_base_competences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
