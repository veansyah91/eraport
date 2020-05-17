<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $filled=['aspek'];

    public function socialperiod()
    {
        return $this->hasMany('App\SocialPeriod');
    }
}
