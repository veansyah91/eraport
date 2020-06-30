<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpiritualPeriod extends Model
{
    protected $fillable=['semester_id','level_id','spiritual_id'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function spiritual()
    {
        return $this->belongsTo('App\Spiritual');
    }

    public function scoreSpiritualStudent()
    {
        return $this->hasMany('App\ScoreSpiritualStudent');
    }
}
