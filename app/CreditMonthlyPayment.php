<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditMonthlyPayment extends Model
{
    protected $fillable = ['student_id','year_id','jumlah_bayar','tanggal_bayar'];

    public function student(){
        return $this->belongsTo('App\Student');
    }
}
