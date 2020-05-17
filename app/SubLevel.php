<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLevel extends Model
{
    protected $fillable = ['alias'];
        
    public function level()
    {        
        return $this->belongsTo('App\Level');
    }

    public function levelsubjetteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }

    public function homeroomteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }

    public function sublevelstudent(){
        return $this->hasMany('App\SubLevelStudent');
    }
}
