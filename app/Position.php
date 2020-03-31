<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['jabatan'];
    
    public function staffperiod(){
        return $this->hasMany('App\StaffPeriod');
    }
}
