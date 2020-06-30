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

    public function levelsubject()
    {
        return $this->hasMany('App\LevelSubject');
    }

    public function spiritualperiod()
    {
        return $this->hasMany('App\SpiritualPeriod');
    }

    public function socialperiod()
    {
        return $this->hasMany('App\SocialPeriod');
    }

    public function extraScore(){
        return $this->hasMany('App\ExtracurricularPeriodScore');
    }

    public function advice(){
        return $this->hasMany('App\Advice');
    }

    public function absent(){
        return $this->hasMany('App\Absent');
    }

    public function uplevel(){
        return $this->hasMany('App\UpLevel');
    }

    public function rank(){
        return $this->hasMany('App\Rank');
    }
}
