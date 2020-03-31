<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['awal','akhir'];

    public function semester()
    {
        return $this->hasMany('App\Semester');
    }
}
