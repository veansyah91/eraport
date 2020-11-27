<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreRatio extends Model
{
    protected $fillable = ['percent','period'];

    public function scoreKnowlegdeCompetence(){
        return $this->hasMany('App\ScoreKnowlegdeCompetence');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
