<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeRoomTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('home_room_teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('staff_id');
            $table->bigInteger('sub_level_id');
            $table->bigInteger('year_id');
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
        Schema::dropIfExists('home_room_teachers');
    }
}
