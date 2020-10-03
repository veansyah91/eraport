<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSchedule extends Model
{
    protected $fillable = ['semester_id','mulai','selesai','kategori'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function studentTestSchedule(){
        return $this->hasMany('App\StudentTestSchedule');
    }

    public function urlSubjectTest()
    {
        return $this->hasMany('App\UrlSubjectTest');
    }
}
