<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeTest extends Model
{
    protected $fillable = ['theme_subject_id','question_id'];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function themeSubject(){
        return $this->belongsTo('App\ThemeSubject');
    }
}
