<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlSubjectTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_subject_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategori');
            $table->unsignedBigInteger('level_subject_id');
            $table->string('url');
            $table->timestamps();

            $table->foreign('level_subject_id')->references('id')->on('level_subjects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_subject_tests');
    }
}
