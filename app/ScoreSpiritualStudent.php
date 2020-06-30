<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreSpiritualStudent extends Model
{
    protected $fillable = ['spiritual_period_id','student_id','score'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function spiritualPeriod(){
        return $this->belongsTo('App\SpiritualPeriod');
    }
}
