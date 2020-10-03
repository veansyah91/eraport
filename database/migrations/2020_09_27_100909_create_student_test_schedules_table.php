<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTestSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_test_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('level_student_id');
            $table->string('allow')->nullable();
            $table->unsignedBigInteger('test_schedule_id');
            $table->timestamps();

            $table->foreign('level_student_id')->references('id')->on('level_students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('test_schedule_id')->references('id')->on('test_schedules')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_test_schedules');
    }
}
