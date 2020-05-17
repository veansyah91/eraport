<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('level_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('level_id');
            $table->bigInteger('subject_id');
            $table->bigInteger('semester_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('level_subjects');
    }
}
