<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeTestSchedule extends Model
{
    protected $fillable = ['kategori', 'tema','tanggal', 'semester_id', 'level_id'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }
}
