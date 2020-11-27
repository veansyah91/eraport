<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectiveAnswer extends Model
{
    protected $fillable = ['option','detail','question_id'];

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
