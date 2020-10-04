<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\StudentTestSchedule;

class StudentHelper
{

    public static function testPermit($levelStudent, $testSchedules)
    {
        return $allow = DB::table('student_test_schedules')
                            ->where('level_student_id', $levelStudent)
                            ->where('test_schedule_id', $testSchedules)
                            ->first();
    }

    public static function test($date)
    {

        return $schedule = DB::table('test_schedules')
                        ->where('semester_id', YearHelper::thisSemester()->id)
                        ->where('mulai','<=',$date)
                        ->where('selesai','>=',$date)
                        ->first();
        
    }

    public static function testSubject($levelsubject, $kategori)
    {

        return $subject = DB::table('url_subject_tests')
                            ->where('kategori', $kategori)
                            ->where('level_subject_id', $levelsubject)
                            ->first();

    }

    public static function testUrl($levelsubject, $kategori)
    {

        return $url = DB::table('url_subject_tests')
                        ->where('kategori', $kategori)
                        ->where('level_subject_id', $levelsubject)
                        ->first();

    }

    public static function themeTestUrl($kategori, $semester, $tema, $level)
    {

        return $url = DB::table('url_theme_tests')
                        ->where('kategori', $kategori)
                        ->where('tema', $tema)
                        ->where('semester_id', $semester)
                        ->where('level_id', $level)
                        ->first();

    }

}