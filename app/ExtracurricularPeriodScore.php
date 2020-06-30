<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularPeriodScore extends Model
{
    protected $fillable = ['semester_id','student_id','extracurricular_id','convert_id'];

    public function semester(){
        return $this->belongsTo('App\Semester');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function extracurricular(){
        return $this->belongsTo('App\Extracurricular');
    }

    public function convert(){
        return $this->belongsTo('App\Convert');
    }

    
}
