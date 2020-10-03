<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlSubjectTest extends Model
{
    protected $fillable = ['url', 'level_subject_id', 'test_schedule_id'];

    public function levelSubject()
    {
        return $this->belongsTo('App\LevelSubject');
    }

    public function testSchedule()
    {
        return $this->belongsTo('App\TestSchedule');
    }
}
