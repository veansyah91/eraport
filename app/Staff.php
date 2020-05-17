<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id'];

    public function getAvatar($image){
        if($image==''){
            return asset('img/user.png');
        }
        return asset('img/'.$image);
    }

    public function staffperiod(){
        return $this->hasMany('App\StaffPeriod');
    }

    public function levelsubjetteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }

    public function homeroomteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }
    
}


