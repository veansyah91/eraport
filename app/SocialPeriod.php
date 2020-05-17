<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialPeriod extends Model
{
    protected $fillable=['semester_id','level_id','social_id'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function social()
    {
        return $this->belongsTo('App\Social');
    }
}
