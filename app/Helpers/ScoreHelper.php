<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ScoreKnowlegdeCompetence;
use App\Convert;
use App\Rank;

class ScoreHelper
{
    public static function scoreMid($subject, $student){
        $score = DB::table('score_knowlegde_competences')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','score_knowlegde_competences.knowledge_base_competence_id')
                    ->join('score_ratios','score_ratios.id','=','score_ratio_id')
                    ->where('knowledge_base_competences.level_subject_id', $subject)
                    ->where('score_knowlegde_competences.student_id', $student)
                    ->where('score_ratios.period', "Tengah Semester")
                    ->avg('score');

        return $score ? $score : 0;
    }

    public static function rataMasingScoreMid($student, $semester){
        $score = DB::table('score_knowlegde_competences')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','score_knowlegde_competences.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('score_ratios','score_ratios.id','=','score_ratio_id')
                    ->where('score_knowlegde_competences.student_id', $student)
                    ->where('score_ratios.period', "Tengah Semester")
                    ->where('level_subjects.semester_id', $semester)
                    ->avg('score');

        return $score ? $score : 0;
    }

    public static function nilaiHuruf($score){
        $converts = Convert::all();

        foreach ($converts as $convert) {
            if ( $score <= $convert->nilai_atas && $score >= $convert->nilai_bawah ) {
                return $convert->nilai_huruf;
            }
        }
    }

    public static function rataNilaiKelasPerMapelMid($students, $subject){
        $jumlahNilai = 0;
        $i = 0;
        foreach ($students as $student) {
            $jumlahNilai += ScoreHelper::scoreMid($subject, $student->student_id);
            $i++;
        }
        return $i > 0 ? $jumlahNilai/$i : 0;
    }

    public static function rataNilaiMidKelas($students, $semester){
        $jumlahNilai = 0;
        $i = 0;
        foreach ($students as $student) {
            $jumlahNilai += ScoreHelper::rataMasingScoreMid($student->student_id, $semester);
            $i++;
        }
        return $i > 0 ? $jumlahNilai/$i : 0;
    }

    public static function rank($student, $semester){
        return $rank = Rank::where('student_id',$student)
                            ->where('semester_id', $semester)->first();
    }
}