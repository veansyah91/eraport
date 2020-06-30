<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScorePracticeCompetence extends Model
{
    protected $fillable = ['score_ratio_id','student_id','practice_base_competence_id'];

    public function scoreRatio()
    {
        return $this->belongsTo('App\ScoreRatio');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function practiceBaseCompetence()
    {
        return $this->belongsTo('App\PracticeBaseCompetence');
    }

}
