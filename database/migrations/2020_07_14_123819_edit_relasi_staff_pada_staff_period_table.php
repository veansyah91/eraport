<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditRelasiStaffPadaStaffPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff_periods', function (Blueprint $table) {
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
        Schema::table('staff_periods', function (Blueprint $table) {
            //
        });
    }
}
