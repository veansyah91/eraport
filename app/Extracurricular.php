<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillabe=['nama'];

    public function extraScore(){
        return $this->hasMany('App\ExtracurricularPeriodScore');
    }
}
