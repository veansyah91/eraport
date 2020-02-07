<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLevel extends Model
{
    protected $fillable = ['alias'];
        
    public function level()
    {        
        return $this->belongsTo('App\Level');
    }
}
