<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['year_id','semester'];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function staffperiod(){
        return $this->hasMany('App\StaffPeriod');
    }
}