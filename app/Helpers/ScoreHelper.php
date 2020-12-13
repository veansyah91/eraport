<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ScoreKnowlegdeCompetence;
use App\Convert;
use App\Rank;
use App\ScoreRatio;
use App\Advice;

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

    public static function rataMasingScoreMid($student, $semester, $level){
        $levelSubjects = DB::table('level_subjects')
                            ->where('semester_id', $semester)
                            ->where('level_id', $level)
                            ->get();

        $jumlahNilai = 0;
        $jumlahMapel = 0;

        
        foreach ( $levelSubjects as $levelSubject ) {
            $score = ScoreHelper::scoreMid($levelSubject->id, $student);
            // dd($score);
            $jumlahNilai += $score;
            $score > 0 ? $jumlahMapel++ : '';
            
        }

        return $jumlahMapel > 0 ? $jumlahNilai/$jumlahMapel : 0;
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

    public static function rataNilaiMidKelas($students, $semester, $level){
        $jumlahNilai = 0;
        $i = 0;
        foreach ($students as $student) {
            $jumlahNilai += ScoreHelper::rataMasingScoreMid($student->student_id, $semester, $level);
            $i++;
        }
        return $i > 0 ? $jumlahNilai/$i : 0;
    }

    public static function rank($student, $semester){
        return $rank = Rank::where('student_id',$student)
                            ->where('semester_id', $semester)->first();
    }

    public static function knowledgeScore($student, $period, $kd){
        return $score = DB::table('score_knowlegde_competences')
                        ->where('knowledge_base_competence_id',$kd)
                        ->where('student_id',$student)
                        ->where('score_ratio_id',$period)
                        ->first();
    }

    public static function practiceScore($student,$kd){
        return $score = DB::table('score_practice_competences')
                            ->where('practice_base_competence_id',$kd)
                            ->where('student_id',$student)
                            ->first();
    }

    public static function reportScorePerSubject($student, $levelSubject){
        $score = 0;

        $parts = ScoreRatio::all();

        foreach ($parts as $part) {
            $rataPerKd = DB::table('score_knowlegde_competences')
                            ->join('knowledge_base_competences','knowledge_base_competences.id','=','score_knowlegde_competences.knowledge_base_competence_id')
                            ->where('score_knowlegde_competences.student_id', $student)
                            ->where('score_knowlegde_competences.score_ratio_id', $part->id)
                            ->where('knowledge_base_competences.level_subject_id', $levelSubject)
                            ->avg('score');

            $score += $rataPerKd*$part->percent/100;
        }

        return $score;
    }

    public static function avScorePerCompentence($student, $basecompetence)
    {
        $score = DB::table('score_knowlegde_competences')
                        ->where('student_id', $student)
                        ->where('knowledge_base_competence_id', $basecompetence)
                        ->where('score','>', 0)
                        ->avg('score');

        return $score? $score : 0;
    }

    public static function jumlahMasingScoreMid($student, $semester){
        $score = DB::table('score_knowlegde_competences')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','score_knowlegde_competences.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('score_ratios','score_ratios.id','=','score_ratio_id')
                    ->where('score_knowlegde_competences.student_id', $student)
                    ->where('score_ratios.period', "Tengah Semester")
                    ->where('level_subjects.semester_id', $semester)
                    ->sum('score');

        return $score ? $score : 0;
    }

    public static function advice($student, $semester, $level)
    {
        $advice = DB::table('advices')->where('semester_id', $semester)
                                ->where('student_id', $student)
                                ->where('level_id', $level)
                                ->select('saran')
                                ->first();

        return $advice ? $advice->saran : '';
    }

    public static function absent($student, $semester, $level)
    {
        return $absent = DB::table('absents')->where('semester_id', $semester)
                                        ->where('student_id', $student)
                                        ->where('level_id', $level)
                                        ->first();     
    }
}