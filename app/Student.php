<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function levelstudent(){
        return $this->hasMany('App\LevelStudent');
    }

    public function scoreSocialStudent()
    {
        return $this->hasMany('App\ScoreSocialStudent');
    }

    public function scoreSpiritualStudent()
    {
        return $this->hasMany('App\ScoreSpiritualStudent');
    }

    public function scoreKnowlegdeCompetence(){
        return $this->hasMany('App\ScoreKnowlegdeCompetence');
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
