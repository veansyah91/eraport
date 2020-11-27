<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('level_id');
            $table->string('tema');
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_subjects');
    }
}
