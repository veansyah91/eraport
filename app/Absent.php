<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $fillable = ['student_id','level_id','semester_id','keterangan','hari'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function semester(){
        return $this->belongsTo('App\Semester');
    }
}
