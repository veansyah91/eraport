<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Convert;
use App\Extracurricular;
use App\ExtracurricularPeriodScore;
use App\KnowledgeBaseCompetence;
use App\PracticeBaseCompetence;
use App\Level;
use App\LevelSubject;
use App\Semester;
use App\Student;
use App\SocialPeriod;
use App\ScoreRatio;
use App\ScoreKnowlegdeCompetence;
use App\SpiritualPeriod;
use App\SubLevel;
use App\ScoreSocialStudent;
use App\ScoreSpiritualStudent;
use Illuminate\Support\Facades\DB;


class ScoreController extends Controller
{
    public function index(Level $level)
    {
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
    
        $sublevels = DB::table('sub_levels')
                    ->where('level_id',$level->id)
                    ->get();                    
                    
        $socialperiods = DB::table('social_periods')
                        ->join('socials','socials.id','=','social_periods.social_id')
                        ->where('level_id',$level->id)
                        ->where('semester_id',$semester->id)
                        ->select('social_periods.*','socials.aspek')
                        ->get();

        $spiritualperiods = DB::table('spiritual_periods')
                            ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                            ->where('level_id',$level->id)
                            ->where('semester_id',$semester->id)
                            ->select('spiritual_periods.*','spirituals.aspek')
                            ->get();
        // dd($spiritualperiods);

        $studentperiods = DB::table('level_students')
                            ->join('students','students.id','=','level_students.student_id')
                            ->join('sub_level_students','sub_level_students.level_student_id','=','level_students.id')
                            ->where('level_students.level_id',$level->id)
                            ->where('level_students.year_id',$semester->year_id)
                            ->select('students.id','students.nama','sub_level_students.sub_level_id')
                            ->get();

        $levelsubjects = DB::table('level_subjects')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_id',$level->id)
                            ->where('semester_id',$semester->id)
                            ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of')
                            ->get();
        $extras = DB::table('extracurriculars')->get();
        
        $converts = Convert::all();
        
        return view('scores.index',compact('converts','extras','level','sublevels','socialperiods','spiritualperiods','studentperiods','levelsubjects','semester'));
    }

    public function createSocialScore(Request $request, SocialPeriod $socialperiod, Student $student)
    {

        $scoresocial = ScoreSocialStudent::updateOrCreate(
                                ['social_period_id' => $socialperiod->id, 
                                 'student_id' => $student->id],
                                ['score' => $request->score]
        );

        return redirect('/score/'.$socialperiod->level_id)->with('status','Nilai Sosial '.$student->nama.' Berhasil Ditambahkan');
    }

    public function createSpiritualScore(Request $request, $spiritualperiod, Student $student)
    {
        $spiritualDetail = SpiritualPeriod::find($spiritualperiod);
        // dd($spiritualDetail);
        $scorespiritual = ScoreSpiritualStudent::updateOrCreate(
                                ['spiritual_period_id' => $spiritualDetail->id, 
                                 'student_id' => $student->id],
                                ['score' => $request->score]
                            );

        return redirect('/score/'.$spiritualDetail->level_id)->with('status','Nilai Sosial '.$student->nama.' Berhasil Ditambahkan');
    }
    
    public function addSubjectScore(LevelSubject $levelsubject, SubLevel $sublevel)
    {

        $basecompetences = DB::table('knowledge_base_competences')
                                ->where('level_subject_id',$levelsubject->id)
                                ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();

        return view('scores.create-level-subject',compact('levelsubject','sublevelstudents','sublevel','basecompetences','ratio'));
    }

    public function createKnowledgeScore(Request $request, SubLevel $sublevel, KnowledgeBaseCompetence $knowledge, ScoreRatio $scoreratio, Student $student)
    {
        
        $scores = DB::table('score_knowlegde_competences')
                    ->updateOrInsert(
                        ['knowledge_base_competence_id' => $knowledge->id, 'student_id' => $student->id, 'score_ratio_id' => $scoreratio->id],
                        ['score' => $request->score]
                    );

        return redirect('/score/'.$knowledge->level_subject_id.'/'.$sublevel->id.'/add-score-subject')->with('status','Nilai Pengetahuan Berhasil Ditambahkan');
    }

    public function addPracticeSubjectScore(LevelSubject $levelsubject, SubLevel $sublevel)
    {

        $basecompetences = DB::table('practice_base_competences')
                                ->where('level_subject_id',$levelsubject->id)
                                ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();

        return view('scores.create-practice-level-subject',compact('levelsubject','sublevelstudents','sublevel','basecompetences','ratio'));
    }

    public function createPracticeScore(Request $request, SubLevel $sublevel, PracticeBaseCompetence $practice, Student $student)
    {
        if ($request->praktek) {
            $scores = DB::table('score_practice_competences')
                    ->updateOrInsert(
                        ['practice_base_competence_id' => $practice->id, 'student_id' => $student->id],
                        ['praktek' => $request->praktek]
                    );
            }
            elseif ($request->produk) {
                $scores = DB::table('score_practice_competences')
                        ->updateOrInsert(
                            ['practice_base_competence_id' => $practice->id, 'student_id' => $student->id],
                            ['produk' => $request->produk]
                        );
                }elseif ($request->proyek) {
                    $scores = DB::table('score_practice_competences')
                        ->updateOrInsert(
                            ['practice_base_competence_id' => $practice->id, 'student_id' => $student->id],
                            ['proyek' => $request->proyek]
                        );
                }
        
        return redirect('/score/'.$practice->level_subject_id.'/'.$sublevel->id.'/add-score-practice-subject')->with('status','Nilai Keterampilan Berhasil Ditambahkan');
    }

    public function createExtra(Request $request, Level $level, Semester $semester, Student $student)
    {
        $extra = new ExtracurricularPeriodScore;
        $extra->extracurricular_id = $request->extra;
        $extra->semester_id = $semester->id;
        $extra->student_id = $student->id;
        $extra->save();

        return redirect('/score/'.$level->id)->with('status','Ekstrakurukuler '.$student->nama.' Berhasil Ditambahkan');
    }

    public function editExtra(Request $request, Level $level, Semester $semester, Student $student, ExtracurricularPeriodScore $extra)
    {
        
        ExtracurricularPeriodScore::where('id',$extra->id)
                    ->update([
                        'convert_id' => $request->score
                    ]);

        return redirect('/score/'.$level->id)->with('status','Ekstrakurukuler '.$student->nama.' Berhasil Ditambahkan');
    }

    public function addAdvice(Request $request, Level $level, Semester $semester, Student $student)
    {
        
        $scores = DB::table('advices')
                    ->updateOrInsert(
                        ['level_id' => $level->id, 'student_id' => $student->id, 'semester_id' => $semester->id],
                        ['saran' => $request->advice]
                    );

        return redirect('/score/'.$level->id)->with('status','Saran untuk '.$student->nama.' Berhasil Ditambahkan');
    }

    public function addAbsent(Request $request, Level $level, Semester $semester, Student $student)
    {
        if ($request->sakit){
            $scores = DB::table('absents')
                    ->updateOrInsert(
                        ['level_id' => $level->id, 'student_id' => $student->id, 'semester_id' => $semester->id],
                        ['sakit' => $request->sakit]
                    );
        } elseif ($request->izin) {
            $scores = DB::table('absents')
                    ->updateOrInsert(
                        ['level_id' => $level->id, 'student_id' => $student->id, 'semester_id' => $semester->id],
                        ['izin' => $request->izin]
                    );
        } elseif ($request->tanpa_keterangan) {
            $scores = DB::table('absents')
                    ->updateOrInsert(
                        ['level_id' => $level->id, 'student_id' => $student->id, 'semester_id' => $semester->id],
                        ['tanpa_keterangan' => $request->tanpa_keterangan]
                    );
        }
        

        return redirect('/score/'.$level->id)->with('status','Ketidakhadiran '.$student->nama.' Berhasil Ditambahkan');
    }

    public function addStatus(Request $request, Level $level, Semester $semester, Student $student)
    {
        $status = DB::table('up_levels')
                ->updateOrInsert(
                    ['student_id' => $student->id, 'semester_id' => $semester->id],
                    ['status' => $request->status]
                );        

        return redirect('/score/'.$level->id)->with('status','Status Kenaikan Kelas '.$student->nama.' Berhasil Diatur');
    }
}
