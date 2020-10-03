<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTestSchedule extends Model
{
    protected $fillable = ['level_subject_id','tanggal','kategori'];

    public function levelSubject(){
        return $this->belongsTo('App\LevelSubject');
    }
}
