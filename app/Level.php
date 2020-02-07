<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function subLevels()
    {
        return $this->hasMany('App\SubLevel');
    }
}
