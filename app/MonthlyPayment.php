<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    protected $fillable = ['student_id', 'jumlah'];
    
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
