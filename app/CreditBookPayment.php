<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditBookPayment extends Model
{
    protected $fillable = ['book_payment_id','tanggal_bayar','jumlah'];

    public function bookpayment(){
        return $this->belongsTo('App\BookPayment');
    }
}
