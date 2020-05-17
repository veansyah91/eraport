<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelSubjectTeachers extends Model
{
    protected $fillable = ['level_subject_id','staff_id','sub_level_id'];

    public function levelsubject()
    {        
        return $this->belongsTo('App\LevelSubject');
    }

    public function staff()
    {        
        return $this->belongsTo('App\Staff');
    }

    public function sublevel()
    {        
        return $this->belongsTo('App\SubLevel');
    }


}
