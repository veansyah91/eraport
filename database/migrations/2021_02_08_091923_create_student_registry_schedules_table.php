<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registry_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('tahun');
            $table->date('mulai');
            $table->date('akhir');
            $table->string('kategori');
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
        Schema::dropIfExists('student_registry_schedules');
    }
}
