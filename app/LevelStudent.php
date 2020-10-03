<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelStudent extends Model
{
    protected $fillable=['year_id','level_id','student_id'];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function sublevelstudent(){
        return $this->hasOne('App\SubLevelStudent');
    }

    public function studentTestSchedule(){
        return $this->hasMany('App\StudentTestSchedule');
    }
}
