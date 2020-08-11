<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryPayment extends Model
{
    protected $fillable = ['student_id', 'total'];
    
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
