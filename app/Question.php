<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // protected $fillable = ['knowledge_base_competence_id', 'question', 'answer_type', 'score_ratio_id','image', 'number_of_answers', 'answer'];
    protected $guarded = ['id'];

    public function knowledgeBaseCompetence()
    {
        return $this->belongsTo('App\KnowledgeBaseCompetence');
    }

    public function answer()
    {
        return $this->hasMany('App\ObjectiveAnswer');
    }

    public function period()
    {
        return $this->hasMany('App\ScoreRatio');
    }

    public function themeTest()
    {
        return $this->hasMany('App\ThemeTest');
    }
}
