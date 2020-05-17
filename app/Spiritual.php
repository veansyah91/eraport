<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spiritual extends Model
{
    protected $fillable = ['aspek'];

    public function spiritualperiod()
    {
        return $this->hasMany('App\SpiritualPeriod');
    }
}
