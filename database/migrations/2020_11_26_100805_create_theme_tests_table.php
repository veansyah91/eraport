<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('theme_subject_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            $table->foreign('theme_subject_id')->references('id')->on('theme_subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_tests');
    }
}
