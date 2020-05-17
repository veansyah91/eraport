<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticeBaseCompetence extends Model
{
    protected $fillable = ['level_subject_id','kode','keterampilan_kompetensi_dasar'];

    public function levelSubject(){
        return $this->belongsTo('App\LevelSubject');
    }
}
