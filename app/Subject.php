<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['mata_pelajaran','kategori'];

    public function levelsubject()
    {
        return $this->hasMany('App\LevelSubject');
    }
}
