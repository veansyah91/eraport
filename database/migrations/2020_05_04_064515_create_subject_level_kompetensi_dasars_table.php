<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectLevelKompetensiDasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_level_kompetensi_dasars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('level_subject_id')->unsigned();
            $table->string('pengetahuan_kompetensi_dasar');

            $table->foreign('subject_id')->references('id')->on('level_subjects')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('subject_level_kompetensi_dasars');
    }
}
