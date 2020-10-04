<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\ThemeTestSchedule;
use App\SubjectTestSchedule;
use App\UrlThemeTest;

use App\Helpers\YearHelper;



class TestScheduleHelper
{
    public static function schedule($subject, $kategori){
        $schedule = SubjectTestSchedule::where('level_subject_id', $subject)
                                        ->where('kategori', $kategori)
                                        ->first();

        return $schedule ? $schedule : null;
    }

    public static function themeTest($kategori, $level, $tema){
        $schedule = ThemeTestSchedule::where('kategori', $kategori)
                                        ->where('tema', $tema)
                                        ->where('semester_id', YearHelper::thisSemester()->id)
                                        ->where('level_id', $level)
                                        ->first();

        return $schedule ? $schedule : null;
    }

    public static function urlTest($tema, $kategori, $level){
        $url = UrlThemeTest::where('tema', $tema)
                            ->where('kategori', $kategori)
                            ->where('level_id', $level)
                            ->where('semester_id', YearHelper::thisSemester()->id)
                            ->first();

        return $url ? $url : null;
    }
}