<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeRoomTeacher extends Model
{
    protected $fillable = ['staff_id','sub_level_id','year_id'];

    public function staff(){
        return $this->belongsTo('App\Staff');
    }

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function SubLevel(){
        return $this->belongsTo('App\SubLevel');
    }
}
