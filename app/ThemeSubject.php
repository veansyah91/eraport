<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeSubject extends Model
{
    protected $fillable = ['semester_id', 'level_id', 'tema'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function themeTest()
    {
        return $this->hasMany('App\ThemeTest');
    }
}
