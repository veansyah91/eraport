<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestSchedule extends Model
{
    protected $fillable = ['level_student_id','allow','test_schedule_id'];

    public function levelStudent(){
        return $this->belongsTo('App\LevelStudent');
    }

    public function testSchedule(){
        return $this->belongsTo('App\TestSchedule');
    }
}
