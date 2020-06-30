<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $fillable = ['student_id','level_id','semester_id','saran'];

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function semester(){
        return $this->belongsTo('App\Semester');
    }

}
