<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['student_id','semester_id','rank'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function semester(){
        return $this->belongsTo('App\Semester');
    }
}
