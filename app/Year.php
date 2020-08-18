<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['awal','akhir'];

    public function semester()
    {
        return $this->hasMany('App\Semester');
    }

    public function homeroomteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }

    public function levelstudent(){
        return $this->hasMany('App\LevelStudent');
    }

    public function bookpayment(){
        return $this->hasMany('App\BookPayment');
    }
}
