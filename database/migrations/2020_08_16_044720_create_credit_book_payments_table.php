<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditBookPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_book_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_payment_id');
            $table->date('tanggal_bayar');
            $table->bigInteger('jumlah');
            $table->timestamps();

            $table->foreign('book_payment_id')->references('id')->on('book_payments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_book_payments');
    }
}
