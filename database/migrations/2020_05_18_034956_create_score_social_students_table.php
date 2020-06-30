<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreSocialStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_social_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('social_period_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('score')->unsigned();
            $table->timestamps();

            $table->foreign('social_period_id')->references('id')->on('social_periods')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('score_social_students');
    }
}
