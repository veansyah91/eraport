<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiSemesterToLevelSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_subjects', function (Blueprint $table) {
            $table->bigInteger('semester_id')->unsigned()->change();
            $table->foreign('semester_id')->references('id')->on('semesters')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_subjects', function (Blueprint $table) {
            //
        });
    }
}
