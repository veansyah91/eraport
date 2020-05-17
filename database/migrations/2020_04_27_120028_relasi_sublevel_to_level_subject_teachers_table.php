<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiSublevelToLevelSubjectTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_subject_teachers', function (Blueprint $table) {
            $table->bigInteger('sub_level_id')->unsigned()->change();
            $table->foreign('sub_level_id')->references('id')->on('sub_levels')
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
