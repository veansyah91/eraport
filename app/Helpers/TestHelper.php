<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\ThemeTestSchedule;
use App\SubjectTestSchedule;
use App\UrlThemeTest;
use App\ObjectiveAnswer;
use App\Question;
use App\KnowledgeBaseCompetence;
use App\ThemeSubject;

use App\Helpers\YearHelper;

class TestHelper
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

    public static function answer($question)
    {
        return $answer = ObjectiveAnswer::where('question_id', $question)->get();
    }

    public static function kd($id)
    {
        return $kd = KnowledgeBaseCompetence::where('id', $id)->first();
    }

    public static function countQuestion($levelSubject, $period)
    {
        $countQuestion = DB::table('questions')
                                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                                    ->where('questions.score_ratio_id', $period)
                                    ->where('knowledge_base_competences.level_subject_id', $levelSubject)
                                    ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function countThemeQuestion($themesubject, $period)
    {
        $theme = ThemeSubject::where('id', $themesubject)->first();
        $countQuestion = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->where('level_subjects.level_id', $theme->level_id)
                        ->where('level_subjects.semester_id', $theme->semester_id)
                        ->where('questions.score_ratio_id', $period)
                        ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function objcetiveAnswerQuestion($levelSubject, $period)
    {
        $countQuestion = DB::table('questions')
                                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                                    ->where('questions.score_ratio_id', $period)
                                    ->where('knowledge_base_competences.level_subject_id', $levelSubject)
                                    ->where('questions.answer_type', 'objective')
                                    ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function essayAnswerQuestion($levelSubject, $period)
    {
        $countQuestion = DB::table('questions')
                                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                                    ->where('questions.score_ratio_id', $period)
                                    ->where('knowledge_base_competences.level_subject_id', $levelSubject)
                                    ->where('questions.answer_type', 'essay')
                                    ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function objectiveThemeQuestion($themesubject, $period)
    {
        $theme = ThemeSubject::where('id', $themesubject)->first();
        $countQuestion = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->where('level_subjects.level_id', $theme->level_id)
                        ->where('level_subjects.semester_id', $theme->semester_id)
                        ->where('questions.score_ratio_id', $period)
                        ->where('questions.answer_type', 'objective')
                        ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function essayThemeQuestion($themesubject, $period)
    {
        $theme = ThemeSubject::where('id', $themesubject)->first();
        $countQuestion = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->where('level_subjects.level_id', $theme->level_id)
                        ->where('level_subjects.semester_id', $theme->semester_id)
                        ->where('questions.score_ratio_id', $period)
                        ->where('questions.answer_type', 'essay')
                        ->count();

        return $countQuestion ? $countQuestion : 0;
    }

    public static function spiritualScore($spiritualPeriod, $student)
    {
        $score = DB::table('score_spiritual_students')
                    ->where('spiritual_period_id', $spiritualPeriod)
                    ->where('student_id', $student)
                    ->first();

        return $score ? $score->score : 0;
    }
}