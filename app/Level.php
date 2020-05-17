<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function subLevels()
    {
        return $this->hasMany('App\SubLevel');
    }
    
    public function levelsubject()
    {
        return $this->hasMany('App\LevelSubject');
    }

    public function levelstudent(){
        return $this->hasMany('App\LevelStudent');
    }

    public function spiritualperiod()
    {
        return $this->hasMany('App\SpiritualPeriod');
    }

    public function socialperiod()
    {
        return $this->hasMany('App\SocialPeriod');
    }
}
