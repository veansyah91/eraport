<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreKnowlegdeCompetence extends Model
{
    protected $fillable = ['score_ratio_id','student_id','knowledge_base_competence_id'];

    public function scoreRatio()
    {
        return $this->belongsTo('App\ScoreRatio');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function knowledgeBaseCompetence()
    {
        return $this->belongsTo('App\KnowledgeBaseCompetence');
    }

    
}
