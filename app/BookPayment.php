<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPayment extends Model
{
    protected $fillable = ['student_id','year_id','jumlah'];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function credit(){
        return $this->hasMany('App\CreditBookPayment');
    }
}
