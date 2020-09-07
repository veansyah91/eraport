<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\StaffPeriod;
use App\HomeRoomTeacher;
use App\LevelSubjectTeachers;
use App\Helpers\YearHelper;

class TeacherHelper
{
    public static function checkTeacher(){
        return $status = StaffPeriod::where('staff_id', Auth::user()->staff_id)->where('semester_id', YearHelper::thisSemester()->id)->where('position_id', 5)->first();
    }

    public static function getLevel(){
        return $levels = DB::table('level_subject_teachers')
                            ->join('level_subjects','level_subjects.id','=','level_subject_teachers.level_subject_id')
                            ->join('levels','levels.id','=','level_subjects.level_id')
                            ->where('level_subject_teachers.staff_id', Auth::user()->staff_id)
                            ->select('levels.kelas','levels.id')->distinct()->get();
    }

    public static function getSubject($subKelas){
        return $subjects = DB::table('level_subject_teachers')
                                ->join('level_subjects','level_subjects.id','=','level_subject_teachers.level_subject_id')
                                ->join('subjects','subjects.id','=','level_subjects.subject_id')
                                ->where('level_subject_teachers.staff_id', Auth::user()->staff_id)
                                ->where('level_subject_teachers.sub_level_id', $subKelas)
                                ->where('level_subjects.semester_id', YearHelper::thisSemester()->id)
                                ->select('subjects.mata_pelajaran','level_subject_teachers.sub_level_id','level_subject_teachers.staff_id','level_subject_teachers.level_subject_id')
                                ->get();
    }

    public static function getHomeRoom(){
        return $level = HomeRoomTeacher::where('staff_id', Auth::user()->staff_id)
                        ->where('year_id', YearHelper::thisSemester()->year_id)
                        ->first();
    }
}