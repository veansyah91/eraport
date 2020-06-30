<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{
    protected $fillable = ['nilai_atas','nilai_bawah','nilai_huruf','penjelasan','predikat'];

    public function extraScore(){
        return $this->hasMany('App\ExtracurricularPeriodScore');
    }
}
