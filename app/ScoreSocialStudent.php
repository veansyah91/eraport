<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreSocialStudent extends Model
{
    protected $fillable = ['social_period_id','student_id','score'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function socialPeriod(){
        return $this->belongsTo('App\SocialPeriod');
    }
}
