<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLevelStudent extends Model
{
    protected $fillable = ['level_student_id','sub_level_id'];

    public function levelstudent(){
        return $this->belongsTo('App\LevelStudent');
    }

    public function sublevel(){
        return $this->belongsTo('App\SubLevel');
    }
}
