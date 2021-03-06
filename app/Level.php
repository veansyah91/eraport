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

    public function advice(){
        return $this->hasMany('App\Advice');
    }

    public function absent(){
        return $this->hasMany('App\Absent');
    }

    public function themeTestSchedule(){
        return $this->hasMany('App\ThemeTestSchedule');
    }

    public function themeTestUrl(){
        return $this->hasMany('App\UrlThemeTest');
    }

    public function themeSubject()
    {
        return $this->hasMany('App\ThemeSubject');
    }
}
