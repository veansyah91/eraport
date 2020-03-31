<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffPeriod extends Model
{
    protected $fillable = ['semester_id','staff_id','position_id'];

    public function semester(){
        return $this->belongsTo('App\Semester');
    }

    public function staff(){
        return $this->belongsTo('App\Staff');
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }
}
