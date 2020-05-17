<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiLevelSubjectTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_subject_teachers', function (Blueprint $table) {
            
            $table->bigInteger('level_subject_id')->unsigned()->change();
            $table->foreign('level_subject_id')->references('id')->on('level_subjects')
                    ->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('staff_id')->unsigned()->change();
            $table->foreign('staff_id')->references('id')->on('staff')
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
        Schema::table('level_subject_teachers', function (Blueprint $table) {
            //
        });
    }
}
