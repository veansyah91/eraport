<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreSpiritualStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_spiritual_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('spiritual_period_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('score')->unsigned();
            $table->timestamps();

            $table->foreign('spiritual_period_id')->references('id')->on('spiritual_periods')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('score_spiritual_students');
    }
}
