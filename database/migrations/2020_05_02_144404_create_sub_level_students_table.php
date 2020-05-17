<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLevelStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_level_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('level_student_id')->unsigned();
            $table->bigInteger('sub_level_id')->unsigned();
            $table->foreign('level_student_id')->references('id')->on('level_students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_level_id')->references('id')->on('sub_levels')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('sub_level_students');
    }
}
