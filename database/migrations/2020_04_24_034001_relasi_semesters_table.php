<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiSemestersTable extends Migration
{
    public function up()
    {
        Schema::table('semesters', function(Blueprint $table){
            $table->bigInteger('year_id')->unsigned()->change();
            $table->foreign('year_id')->references('id')->on('years')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        //
    }
}
