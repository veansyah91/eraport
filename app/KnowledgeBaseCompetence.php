<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBaseCompetence extends Model
{
    protected $table = 'knowledge_base_competences';

    protected $fillable = ['pengetahuan_kompetensi_dasar','level_subject_id','kode'];

    public function levelSubject(){
        return $this->belongsTo('App\LevelSubject');
    }

    public function scoreKnowlegdeCompetence(){
        return $this->hasMany('App\ScoreKnowlegdeCompetence');
    }
}
