<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SubLevel;

class LevelHelper
{
    public static function subLevel($level){
        return $subLevel = SubLevel::where('level_id', $level)->get();
    }
}