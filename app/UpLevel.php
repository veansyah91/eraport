<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpLevel extends Model
{
    protected $fillable = ['student_id','semester_id','status'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function semester(){
        return $this->belongsTo('App\Semester');
    }

    
}
