<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\SubjectTestSchedule;



class TestScheduleHelper
{
    public static function schedule($subject, $kategori){
        $schedule = SubjectTestSchedule::where('level_subject_id', $subject)
                                        ->where('kategori', $kategori)
                                        ->first();

        return $schedule ? $schedule : null;
    }
}