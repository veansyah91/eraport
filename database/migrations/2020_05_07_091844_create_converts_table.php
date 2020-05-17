<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nilai_bawah');
            $table->integer('nilai_atas');
            $table->char('nilai_huruf');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('converts');
    }
}
