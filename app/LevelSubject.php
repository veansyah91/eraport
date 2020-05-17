<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelSubject extends Model
{
    protected $fillable = ['level_id,subject_id,semester_id'];

    public function level()
    {        
        return $this->belongsTo('App\Level');
    }

    public function subject()
    {        
        return $this->belongsTo('App\Subject');
    }

    public function semester()
    {        
        return $this->belongsTo('App\Semester');
    }

    public function levelsubjetteacher(){
        return $this->hasMany('App\LevelSubjectTeacher');
    }

    public function knowledgeBaseCompetences(){
        return $this->hasMany('App\KnowledgeBaseCompetence');
    }

    public function practiceBaseCompetence(){
        return $this->hasMany('App\PracticeBaseCompetence');
    }
}
