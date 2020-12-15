<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\LevelSubject;
use App\Convert;
use App\Helpers\YearHelper;
use App\Helpers\ScoreHelper;
use App\ObjectiveAnswer;
use App\Level;
use App\SubLevel;
use App\KnowledgeBaseCompetence;
use App\PracticeBaseCompetence;
use App\ScoreRatio;
use App\Student;
use App\Semester;
use App\ScoreSocialStudent;
use App\ScoreSpiritualStudent;
use App\School;
use App\SubLevelStudent;
use App\SpiritualPeriod;
use App\SocialPeriod;
use App\UrlThemeTest;
use App\ThemeSubject;
use App\ThemeTest;
use App\Question;
use App\Extracurricular;
use App\Rank;

use PDF;
use File;

use App\Exports\RekapRaport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function index(SubLevel $sublevel, LevelSubject $levelsubject)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        
        $kompetensidasar = DB::table('knowledge_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();
                            
        $praktekkompetensidasar = DB::table('practice_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();

        $knowledgebasecompetences = DB::table('knowledge_base_competences')
                            ->where('level_subject_id',$levelsubject->id)
                            ->get();

        $practicebasecompetences = DB::table('practice_base_competences')
                                ->where('level_subject_id',$levelsubject->id)
                                ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $scorePeriods = ScoreRatio::all();

        return view('users.teacher.index',compact('sublevel','levelsubject','students','kompetensidasar','praktekkompetensidasar','sublevelstudents','knowledgebasecompetences','practicebasecompetences','scorePeriods'));
    }

    public function storeKnowledgeCompetence(SubLevel $sublevel, LevelSubject $levelsubject, Request $request)
    {

        $kd = new KnowledgeBaseCompetence;
        $kd->level_subject_id = $levelsubject->id;
        $kd->pengetahuan_kompetensi_dasar = $request->kd;
        $kd->kode = $request->kode;
        $kd->save();

        return redirect('/penilaian/'. $sublevel->id . '/' . $levelsubject->id )->with('status','Kompetensi Dasar Berhasil Ditambahkan');
    }

    public function storePracticeCompetence(SubLevel $sublevel, LevelSubject $levelsubject, Request $request)
    {

        $kd = new PracticeBaseCompetence;
        $kd->level_subject_id = $levelsubject->id;
        $kd->keterampilan_kompetensi_dasar = $request->kd;
        $kd->kode = $request->kode;
        $kd->save();

        return redirect('/penilaian/'. $sublevel->id . '/' . $levelsubject->id )->with('status','Kompetensi Dasar Berhasil Ditambahkan');   
    }

    public function updateKnowledgeCompetence(SubLevel $sublevel, KnowledgeBaseCompetence $knowledgebasecompetence, Request $request){
        KnowledgeBaseCompetence::where('id',$knowledgebasecompetence->id)
                                ->update([
                                    'kode' => $request->kode,
                                    'pengetahuan_kompetensi_dasar' => $request->kd,
                                ]);
        return redirect('/penilaian/'. $sublevel->id . '/' . $knowledgebasecompetence->level_subject_id )->with('status','Kompetensi Dasar Berhasil Diubah'); 
    }

    public function updatePracticeCompetence(SubLevel $sublevel, PracticeBaseCompetence $practicebasecompetence, Request $request){

        PracticeBaseCompetence::where('id',$practicebasecompetence->id)
                                ->update([
                                    'kode' => $request->kode,
                                    'keterampilan_kompetensi_dasar' => $request->kd,
                                ]);
        return redirect('/penilaian/'. $sublevel->id . '/' . $practicebasecompetence->level_subject_id )->with('status','Kompetensi Dasar Berhasil Diubah'); 
    }

    public function deleteKnowledgeCompetence(SubLevel $sublevel, KnowledgeBaseCompetence $knowledgebasecompetence)
    {
        KnowledgeBaseCompetence::destroy($knowledgebasecompetence->id);

        return redirect('/penilaian/'. $sublevel->id . '/' . $knowledgebasecompetence->level_subject_id )->with('status','Kompetensi Dasar Berhasil Diubah'); 
    }

    public function deletePracticeCompetence(SubLevel $sublevel, PracticeBaseCompetence $practicebasecompetence)
    {
        PracticeBaseCompetence::destroy($practicebasecompetence->id);

        return redirect('/penilaian/'. $sublevel->id . '/' . $practicebasecompetence->level_subject_id )->with('status','Kompetensi Dasar Berhasil Diubah'); 
    }

    public function knowledgeScore(SubLevel $sublevel, LevelSubject $levelsubject)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $basecompetences = DB::table('knowledge_base_competences')
                            ->where('level_subject_id',$levelsubject->id)
                            ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();
        return view('users.teacher.nilai-pengetahuan', compact('sublevel','levelsubject','students','sublevelstudents','basecompetences','ratio'));
    }

    public function createKnowledgeScoreStudent(SubLevel $sublevel, LevelSubject $levelsubject, Student $student)
    {
        $basecompetences = DB::table('knowledge_base_competences')
                            ->where('level_subject_id',$levelsubject->id)
                            ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();
        return view('users.teacher.nilai-pengetahuan-siswa', compact('sublevel','levelsubject','student','basecompetences','ratio'));
    }

    public function storeKnowledgeScoreStudent(SubLevel $sublevel, LevelSubject $levelsubject, Student $student, Request $request)
    {
        // dd($request);
        for ($i=1; $i <= count($request->ratio); $i++) { 
            for ($j=1; $j <= count($request->kd); $j++) { 
                if ($request->scoreknowledge[$i][$j]) {
                    $scores = DB::table('score_knowlegde_competences')
                                    ->updateOrInsert(
                                        ['knowledge_base_competence_id' => $request->kd[$j], 'student_id' => $student->id, 'score_ratio_id' => $request->ratio[$i]],
                                        ['score' => $request->scoreknowledge[$i][$j]]
                                    );
                }
                else {
                    $scores = DB::table('score_knowlegde_competences')
                                    ->where('knowledge_base_competence_id',$request->kd[$j])
                                    ->where('student_id',$student->id)
                                    ->where('score_ratio_id',$request->ratio[$i])
                                    ->delete();
                }
            }
        }
        return redirect('penilaian/' . $sublevel->id . '/' . $levelsubject->id . '/' . $student->id . '/nilai-pengetahuan')->with('status','Nilai Pengetahuan Berhasil Diatur'); 
    }

    public function createKnowledgeScore(Request $request, SubLevel $sublevel, KnowledgeBaseCompetence $knowledge, ScoreRatio $scoreratio, Student $student)
    {        
        if ($request->score) {
            $scores = DB::table('score_knowlegde_competences')
                    ->updateOrInsert(
                        ['knowledge_base_competence_id' => $knowledge->id, 'student_id' => $student->id, 'score_ratio_id' => $scoreratio->id],
                        ['score' => $request->score]
                    );
        }
        
        return redirect('penilaian/' . $sublevel->id . '/' . $knowledge->level_subject_id . '/nilai-pengetahuan')->with('status','Nilai Pengetahuan Berhasil Diatur'); 
    }

    public function practiceScore(SubLevel $sublevel, LevelSubject $levelsubject)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $basecompetences = DB::table('practice_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();
        return view('users.teacher.nilai-keterampilan', compact('sublevel','levelsubject','students','sublevelstudents','basecompetences','ratio'));
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
        
        return redirect('penilaian/' . $sublevel->id . '/' . $practice->level_subject_id . '/nilai-keterampilan')->with('status','Nilai Pengetahuan Berhasil Diatur'); 
    }

    public function createPracticeScoreStudent(SubLevel $sublevel, LevelSubject $levelsubject, Student $student)
    {

        $basecompetences = DB::table('practice_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();

        return view('users.teacher.nilai-keterampilan-siswa', compact('sublevel','levelsubject','student','basecompetences'));
    }

    public function storePracticeScoreStudent(SubLevel $sublevel, LevelSubject $levelsubject, Student $student, Request $request)
    {
        
        for ($i=1; $i <= count($request->kd); $i++) { 
            $score = DB::table('score_practice_competences')
                        ->updateOrInsert(
                            ['practice_base_competence_id' => $request->kd[$i], 'student_id' => $student->id],
                            ['praktek' => $request->nilaiPraktek[$i],
                             'produk' => $request->nilaiProduk[$i],
                             'proyek' => $request->nilaiProyek[$i],
                            ]
                        );
        }

        return redirect('/penilaian/' . $sublevel->id . '/' . $levelsubject->id . '/' . $student->id . '/nilai-keterampilan')->with('status','Nilai Keterampilan Berhasil Diatur');
    }

    public function urlTest(LevelSubject $levelsubject)
    {
        $urlMidTest = DB::table('url_subject_tests')
                            ->where('level_subject_id', $levelsubject->id)
                            ->where('kategori','Tengah Semester')
                            ->first();

        $urlLastTest = DB::table('url_subject_tests')
                            ->where('level_subject_id', $levelsubject->id)
                            ->where('kategori','Akhir Semester')
                            ->first();


        $periods = ScoreRatio::all();

        return view('users.teacher.test-schedule', compact('levelsubject','urlMidTest','urlLastTest','periods'));
    }

    public function printTest(LevelSubject $levelsubject, ScoreRatio $scoreratio)
    {
        $school = School::first();
        $questions = DB::table('questions') 
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->where('knowledge_base_competences.level_subject_id', $levelsubject->id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.*')
                        ->orderBy('questions.number', 'asc')
                        ->get();

        // dd();

        $pdf = PDF::loadView('users.teacher.test-print',['school' => $school, 'levelsubject' => $levelsubject, 'scoreratio' => $scoreratio, 'questions' => $questions]);
        return $pdf->stream('test-' . $levelsubject->subject->mata_pelajaran . '-kelas-' . $levelsubject->level->kelas . '-' . $scoreratio->period . '.pdf');
    }    

    public function printFile(LevelSubject $levelsubject, ScoreRatio $scoreratio)
    {
        $school = School::first();
        $questions = DB::table('questions') 
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->join('subjects','subjects.id','=','level_subjects.subject_id')
                        ->where('knowledge_base_competences.level_subject_id', $levelsubject->id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.id','questions.number','questions.image','questions.explanation','questions.question','questions.answer_type','questions.answer','subjects.mata_pelajaran','knowledge_base_competences.pengetahuan_kompetensi_dasar','knowledge_base_competences.kode')
                        ->orderBy('questions.number', 'asc')
                        ->get();

        // dd($questions);
        $pdf = PDF::loadView('users.teacher.test-file-print',['school' => $school, 'levelsubject' => $levelsubject, 'scoreratio' => $scoreratio, 'questions' => $questions]);
        return $pdf->stream('test-file' . $levelsubject->subject->mata_pelajaran . '-kelas-' . $levelsubject->level->kelas . '-' . $scoreratio->period . '.pdf');
    }
    
    public function printThemeTest(ScoreRatio $scoreratio, ThemeSubject $themesubject)
    {
        
        $school = School::first();
        $questions = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->where('level_subjects.level_id', $themesubject->level_id)
                        ->where('level_subjects.semester_id', $themesubject->semester_id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.*')
                        ->orderBy('questions.number', 'asc')
                        ->get();

        // dd($questions);
        $pdf = PDF::loadView('users.teacher.theme-test-print',['school' => $school, 'scoreratio' => $scoreratio, 'questions' => $questions, 'themesubject' => $themesubject]);
        return $pdf->stream('theme-test-' . $themesubject->tema . '-kelas-' . $themesubject->level->kelas . '-' . $scoreratio->period . '.pdf');
    }

    public function printThemeFile(ScoreRatio $scoreratio, ThemeSubject $themesubject)
    {
        $school = School::first();
        $questions = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->join('subjects','subjects.id','=','level_subjects.subject_id')
                        ->where('level_subjects.level_id', $themesubject->level_id)
                        ->where('level_subjects.semester_id', $themesubject->semester_id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.*','subjects.mata_pelajaran','knowledge_base_competences.pengetahuan_kompetensi_dasar','knowledge_base_competences.kode')
                        ->orderBy('questions.number', 'asc')
                        ->get();

        // dd($questions);
        $pdf = PDF::loadView('users.teacher.theme-test-file-print',['school' => $school, 'scoreratio' => $scoreratio, 'questions' => $questions, 'themesubject' => $themesubject]);
        return $pdf->stream('theme-test-file-' . $themesubject->tema . '-kelas-' . $themesubject->level->kelas . '-' . $scoreratio->period . '.pdf');
    }

    public function showTest(LevelSubject $levelsubject, ScoreRatio $scoreratio)
    {
        $knowledgeCompetences = KnowledgeBaseCompetence::where('level_subject_id', $levelsubject->id)->get();
        $questions = DB::table('questions') 
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->where('knowledge_base_competences.level_subject_id', $levelsubject->id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.*')
                        ->orderBy('questions.number', 'asc')
                        ->get();

                        

        $themeSubject = '';

        return view('users.teacher.test-show', compact('levelsubject','scoreratio','questions','knowledgeCompetences','themeSubject'));
    }

    public function createTest(LevelSubject $levelsubject, ScoreRatio $scoreratio)
    {
        $knowledgeCompetences = KnowledgeBaseCompetence::where('level_subject_id', $levelsubject->id)->get();

        // cek soal
        $questions = DB::table('questions') 
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->where('knowledge_base_competences.level_subject_id', $levelsubject->id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->count();

        return view('users.teacher.test-create', compact('levelsubject','scoreratio','knowledgeCompetences', 'questions'));
    }

    public function storeTest(LevelSubject $levelsubject, ScoreRatio $scoreratio, Request $request)
    {
        // dd($request);
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            // 'image' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        $question = new Question;
        $question->knowledge_base_competence_id = $request->kd;
        $question->score_ratio_id = $scoreratio->id;
        $question->question = $request->pertanyaan;
        $question->explanation = $request->keterangan;

        if ($request->hasFile('image')) {
            $randomNumber = rand(0,10000);
            $request->file('image')->move('img/test/', $randomNumber . $request->file('image')->getClientOriginalName());
            $question->image = $randomNumber . $request->file('image')->getClientOriginalName();
        };

        $question->answer = $request->jawaban;
        $question->number = $request->number < 10 ? '0' . $request->number : $request->number;

        $question->answer_type = $request->objective == "on" ? 'objective' : 'essay';
        $question->number_of_answers = $request->objective == "on" ? $request->jumlahjawaban : 1;
        $question->save();

        if ($request->objective == 'on') {
            for ($i=0; $i < $request->jumlahjawaban; $i++) { 
                if ($request->answer[$i] && $request->obj[$i]) {
                    $answer = new ObjectiveAnswer;
                    $answer->question_id = $question->id;
                    $answer->detail = $request->answer[$i];
                    $answer->option = $request->obj[$i];
                    $answer->save();
                }
            }
        }

        return redirect('/ujian/levelsubjectid=' . $levelsubject->id . '/periodid=' . $scoreratio->id . '/create')->with('status','Soal Ujian Mata Pelajaran' . $levelsubject->subject->mata_pelajaran . 'Berhasil Diatur');
    }

    public function updateNumber(Question $question, Request $request)
    {
        $updateNumber = Question::where('id', $question->id)->update([
                            'number' => $request->number < 10 ? '0' . $request->number : $request->number
                        ]);
            
        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updatekd(Question $question, Request $request)
    {
        $updatekd = Question::where('id', $question->id)->update([
            'knowledge_base_competence_id' => $request->kd
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function deleteImage(Question $question, Request $request)
    {
        // dd($question);
        File::delete('img/test/'.$question->image);

        $deleteImage = Question::where('id', $question->id)->update([
            'image' => null
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateImage(Question $question, Request $request)
    {
        if ($request->hasFile('image')) {
            if ($question->image) {
                File::delete('img/test/'.$question->image);
            }
            $randomNumber = rand(0,10000);
            $request->file('image')->move('img/test/', $randomNumber . $request->file('image')->getClientOriginalName());
            Question::where('id',$question->id)
                ->update([
                    'image' => $randomNumber . $request->file('image')->getClientOriginalName()
                ]);
        };
        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateQuestion(Question $question, Request $request)
    {
        $updateQuestion = Question::where('id', $question->id)->update([
            'question' => $request->pertanyaan
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateAnswerType(Question $question, Request $request)
    {
        $updateAnswerType = Question::where('id', $question->id)->update([
            'answer_type' => $request->answertype,
            'number_of_answers' => $request->answertype == 'objective' ? 3 : 1
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateAnswer(Question $question, Request $request)
    {
        $updateAnswer = Question::where('id', $question->id)->update([
            'answer' => $request->key
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateAnswers(Question $question, Request $request)
    {
        $updateAnswers = Question::where('id', $question->id)->update([
            'number_of_answers' => $request->answers
        ]);

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function deleteQuestion(Question $question, Request $request)
    {
        // cek apakah ada gambar
        
        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();

        if ($question->image) {
            File::delete('img/test/'.$question->image);
        }
        Question::destroy($question->id);
        
        $adaTema = $tema ? $tema->tema : '';
        // dd($adaTema);
        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateAnswerOption(Question $question, Request $request)
    {
        if ($request->answerId) {
            $answer = ObjectiveAnswer::where('id', $request->answerId)->update([
                    'detail' => $request->answerDetail,
                    'option' => $request->answerObj
            ]);
        } else{
            if ($request->answerDetail) {
                $answer = ObjectiveAnswer::create([
                        'question_id' => $question->id,
                        'detail' => $request->answerDetail,
                        'option' => $request->answerObj
                ]);
            }
            
        }

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function updateExplanation(Question $question, Request $request)
    {
        if ($request->keterangan) {
            $updateexplanation = Question::where('id', $question->id)->update([
                'explanation' => $request->keterangan
            ]);
        }
        

        $adaTema = '';
        $tema = DB::table('questions')
                    ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                    ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('questions.id',$question->id)
                    ->select('subjects.tema')
                    ->first();
        
        $adaTema = $tema->tema;

        if ($adaTema) {
            return redirect('/ujian/tema/levelid=' . $question->knowledgeBaseCompetence->levelSubject->level_id .'/semesterId=' . $question->knowledgeBaseCompetence->levelSubject->semester_id .'/periodId=' . $question->score_ratio_id . '/themeId=' . $request->theme . '/showTest');
        } else {
            return redirect('/ujian/levelsubjectid=' . $question->knowledgeBaseCompetence->level_subject_id. '/periodid=' . $question->score_ratio_id);
            
        }
    }

    public function setUrlTest(Request $request, LevelSubject $levelsubject)
    {
        $urlTest = DB::table('url_subject_tests')
                    ->updateOrInsert(
                        ['level_subject_id' => $levelsubject->id,
                        'kategori' => $request->kategori],
                        ['url' => $request->url]
                    );

        return redirect('/url-ujian/levelsubjectid=' . $levelsubject->id)->with('status','URL Ujian Mata Pelajaran' . $levelsubject->subject->mata_pelajaran . 'Berhasil Diatur'); 
    }

    public function urlTestTheme(Level $level)
    {

        $themeSubjects = ThemeSubject::where('level_id', $level->id)
                                    ->where('semester_id', YearHelper::thisSemester()->id)
                                    ->select('tema', 'id')
                                    // ->distinct()
                                    ->get();

        $periods = ScoreRatio::all();
        // dd($themeTestUrls);

        return view('users.teacher.test-schedule-theme', compact('level','themeSubjects','periods'));
    }

    public function createTheme(Level $level, Semester $semester, Request $request)
    {
        $request->validate([
            'tema' => 'unique:theme_subjects',
        ]);
        $themeSubject = ThemeSubject::create([
            'semester_id' => YearHelper::thisSemester()->id,
            'level_id' => $level->id,
            'tema' => $request->tema
        ]);

        return redirect('/ujian/tema/levelid=' . $level->id)->with('status','Tema Berhasil Ditambah'); 
    }

    public function updateTheme(Level $level, Semester $semester, Request $request)
    {
        $themeSubject = ThemeSubject::where('id', $request->themeId)->update([
            'tema' => $request->tema
        ]);
        return redirect('/ujian/tema/levelid=' . $level->id)->with('status','Tema Berhasil Diubah'); 
    }

    public function deleteTheme(Level $level, Semester $semester, Request $request)
    {
        ThemeSubject::destroy($request->themeId);

        return redirect('/ujian/tema/levelid=' . $level->id)->with('status','Tema Berhasil Dihapus'); 
    }

    public function showTestTheme(Level $level, Semester $semester, ScoreRatio $scoreratio, ThemeSubject $themesubject)
    {
        $knowledgeCompetences = DB::table('knowledge_base_competences')
                                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                                        ->join('subjects','subjects.id','=','level_subjects.subject_id')
                                        ->where('subjects.tema', 'on')
                                        ->orderBy('subjects.mata_pelajaran')
                                        ->get();

        $questions = DB::table('theme_tests') 
                        ->join('questions','questions.id','=','question_id')
                        ->join('knowledge_base_competences','knowledge_base_competences.id','=','questions.knowledge_base_competence_id')
                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                        ->where('level_subjects.level_id', $level->id)
                        ->where('level_subjects.semester_id', $semester->id)
                        ->where('questions.score_ratio_id', $scoreratio->id)
                        ->select('questions.*')
                        ->orderBy('questions.number', 'asc')
                        ->get();
                        // dd($questions);
        
        return view('users.teacher.theme-test-show', compact('level','scoreratio','themesubject','knowledgeCompetences','questions'));
    }

    public function createTestTheme(Level $level, Semester $semester, ScoreRatio $scoreratio, ThemeSubject $themesubject)
    {

        $knowledgeCompetences = DB::table('knowledge_base_competences')
                                        ->join('level_subjects','level_subjects.id','=','knowledge_base_competences.level_subject_id')
                                        ->join('subjects','subjects.id','=','level_subjects.subject_id')
                                        ->where('level_subjects.level_id', $level->id)
                                        ->where('level_subjects.semester_id', $semester->id)
                                        ->where('subjects.tema', 'on')
                                        ->select('knowledge_base_competences.id','knowledge_base_competences.kode','knowledge_base_competences.pengetahuan_kompetensi_dasar','subjects.mata_pelajaran')
                                        ->orderBy('knowledge_base_competences.kode')
                                        ->orderBy('subjects.mata_pelajaran')
                                        ->get();
        

        $questions = DB::table('theme_tests') 
                        ->where('theme_subject_id', $themesubject->id)
                        ->count();
        
        return view('users.teacher.theme-test-create', compact('level','semester','scoreratio','themesubject','knowledgeCompetences','questions'));
    }

    public function storeTestTheme(Level $level, Semester $semester, ScoreRatio $scoreratio, ThemeSubject $themesubject, Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            // 'image' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // dd($request);

        $question = new Question;
        $question->knowledge_base_competence_id = $request->kd;
        $question->score_ratio_id = $scoreratio->id;
        $question->question = $request->pertanyaan;
        $question->explanation = $request->keterangan;

        if ($request->hasFile('image')) {
            $randomNumber = rand(0,10000);
            $request->file('image')->move('img/test/', $randomNumber . $request->file('image')->getClientOriginalName());
            $question->image = $randomNumber . $request->file('image')->getClientOriginalName();
        };

        $question->answer = $request->jawaban;
        $question->answer = $request->jawaban;
        $question->number = $request->number < 10 ? '0' . $request->number : $request->number;

        $question->answer_type = $request->objective == "on" ? 'objective' : 'essay';
        $question->number_of_answers = $request->objective == "on" ? $request->jumlahjawaban : 1;
        $question->save();

        if ($request->objective == 'on') {
            for ($i=0; $i < $request->jumlahjawaban; $i++) { 
                if ($request->answer[$i] && $request->obj[$i]) {
                    $answer = new ObjectiveAnswer;
                    $answer->question_id = $question->id;
                    $answer->detail = $request->answer[$i];
                    $answer->option = $request->obj[$i];
                    $answer->save();
                }
            }
        }

        $themeTest = ThemeTest::create([
            'theme_subject_id' => $themesubject->id,
            'question_id' => $question->id
        ]);
        
        return redirect('/ujian/tema/levelid=' . $level->id . '/semesterId=' . $semester->id . '/periodId=' . $scoreratio->id . '/themeId=' . $themesubject->id . '/createTest');
    }

    public function setUrlTestTema(Request $request, Level $level)
    {
        // dd($request);
        if ($request->midsemestercheckbox == 1) {
            $urlTest = DB::table('url_theme_tests')
                    ->updateOrInsert(
                        ['level_id' => $level->id,
                        'semester_id' => YearHelper::thisSemester()->id,
                        'kategori' => "Tengah Semester",
                        'tema' => $request->tema],
                        ['url' => $request->urltemamid]
                    );
        }

        if ($request->lastsemestercheckbox == 1) {
            $urlTest = DB::table('url_theme_tests')
                    ->updateOrInsert(
                        ['level_id' => $level->id,
                        'semester_id' => YearHelper::thisSemester()->id,
                        'kategori' => "Akhir Semester",
                        'tema' => $request->tema],
                        ['url' => $request->urltemalast]
                    );
        }

        return redirect('/url-ujian/tema/levelid=' . $level->id)->with('status','URL Ujian' . $request->tema . 'Pelajaran Berhasil Diatur'); 
    }

    public function updateUrlTestTema(Request $request, Level $level)
    {
        if ($request->url) {
            $urlTest = DB::table('url_theme_tests')
                    ->updateOrInsert(
                        ['level_id' => $level->id,
                        'semester_id' => YearHelper::thisSemester()->id,
                        'kategori' => $request->kategori,
                        'tema' => $request->tema],
                        ['url' => $request->url]
                    );
        }
        

        return redirect('/url-ujian/tema/levelid=' . $level->id)->with('status','URL Ujian' . $request->tema . 'Pelajaran Berhasil Diatur'); 
    }

    public function printMidSemesterReport(SubLevel $sublevel, Semester $semester)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('level_students.year_id', $semester->year_id)
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->select('level_students.student_id','students.nama','students.nisn','students.no_induk')
                        ->get();

        $studentRank = [];
        $i = 0;

        // Berikan Rangking Default
        foreach ($students as $student) {
            $studentRank[$i] = [
                'student_id' => $student->student_id,
                'nilai' => ScoreHelper::rataMasingScoreMid($student->student_id, $semester->id, $sublevel->level_id),
                'semester' => $semester->id,
            ];
            $i++;
        }

        // urutkan rangking raport mid
        
        for ($i=0; $i < count($students); $i++) { 
            $tempstudent = 0;
            $tempnilai = 0;
            
            for ($j=$i; $j < count($students); $j++) { 
                if ($studentRank[$i]["nilai"] < $studentRank[$j]["nilai"]) {
                    $tempnilai= $studentRank[$j]["nilai"];
                    $tempstudent = $studentRank[$j]["student_id"];
                    
                    $studentRank[$j]["nilai"] = $studentRank[$i]["nilai"];
                    $studentRank[$j]["student_id"] = $studentRank[$i]["student_id"];
                    
                    $studentRank[$i]["nilai"] = $tempnilai;
                    $studentRank[$i]["student_id"] = $tempstudent;
                }
            }
        }

        for ($i=0; $i < count($studentRank); $i++) { 
            $rank = Rank:: updateOrCreate(
                ['student_id' => $studentRank[$i]['student_id'], 
                 'semester_id' => $semester->id],
                ['rank' => $i+1]
            );
        }
        
        return view('users.teacher.view-mid-report', compact('students','sublevel','semester'));
    }

    public function printMidSemesterReportStudent(SubLevel $sublevel, Semester $semester, Student $student)
    {
        $school = School::first();
        $kepalasekolah = DB::table('staff_periods')
                    ->join('positions','positions.id','=','staff_periods.position_id')
                    ->join('staff','staff_periods.staff_id','=','staff.id')
                    ->where('positions.jabatan',"KEPALA SEKOLAH")
                    ->select('staff.nama','staff.nik')
                    ->first();

        $levelsubjects = DB::table('level_subjects')
                    ->join('subjects','subjects.id','=','level_subjects.subject_id')
                    ->where('level_subjects.level_id',$sublevel->level_id)
                    ->where('level_subjects.semester_id',$semester->id)
                    ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of','level_subjects.kkm')
                    ->get();

        $jumlahSiswa = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('level_students.level_id',$sublevel->level->id)
                        ->where('level_students.year_id',$semester->year->id)
                        ->where('sub_level_students.sub_level_id',$sublevel->id)
                        ->count();

        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('level_students.year_id', $semester->year_id)
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->select('level_students.student_id','students.nama','students.nisn','students.no_induk')
                        ->get();

                        // dd($levelsubjects);
        $pdf = PDF::loadView('users.teacher.score-mid',['students' => $students, 'student' => $student, 'school'=>$school, 'kepalasekolah' => $kepalasekolah, 'semester' => $semester, 'sublevel' => $sublevel, 'levelsubjects' => $levelsubjects, 'jumlahSiswa' => $jumlahSiswa]);
        return $pdf->download('nilai-raport-'.$student->nama.'.pdf');
    }

    public function spiritual(SubLevel $sublevel)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->paginate(10);

        // dd($sublevelstudents);

        $spirituals = SpiritualPeriod::where('semester_id', YearHelper::thisSemester()->id)
                                        ->where('level_id', $sublevel->level_id)
                                        ->get();

        // dd($spirituals[0]->spiritual->aspek);

        return view('users.teacher.nilai-spiritual', compact('sublevel','students','sublevelstudents','spirituals'));
    }

    public function showSpiritualStudent(SubLevel $sublevel,  $student)
    {
        $studentDetail = Student::find($student);

        $spirituals = SpiritualPeriod::where('semester_id', YearHelper::thisSemester()->id)
                        ->where('level_id', $sublevel->level_id)
                        ->get();
        // dd($studentDetail);
        return view('users.teacher.nilai-spiritual-siswa', compact('studentDetail', 'sublevel', 'spirituals'));
    }

    public function updateSpiritualStudent(SubLevel $sublevel,  $student, Request $request)
    {
        $maxData = count($request->spiritualPeriod);

        for ($i=1; $i <=$maxData; $i++) { 
            if ($request->spiritualscore[$i]) {
                $createScoreSpiritual = ScoreSpiritualStudent::updateOrCreate(
                    ['spiritual_period_id' => $request->spiritualPeriod[$i],
                     'student_id' => $student],
                    ['score' => $request->spiritualscore[$i]]
                );
            } else{
                $delete = DB::table('score_spiritual_students')->where('spiritual_period_id', $request->spiritualPeriod[$i])
                                                ->where('student_id', $student)
                                                ->delete();
            }
        }

        return redirect('/subLevelId=' . $sublevel->id . '/studentId=' . $student . '/penilaian/spiritual')->with('status','Nilai Spiritual Berhasil Diisi');
    }

    public function social(SubLevel $sublevel)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->paginate(10);

        

        $socials = SocialPeriod::where('semester_id', YearHelper::thisSemester()->id)
                                        ->where('level_id', $sublevel->level_id)
                                        ->get();

        // dd($socials[0]->social->aspek);

        return view('users.teacher.nilai-sosial', compact('sublevel','students','sublevelstudents','socials'));
    }

    public function showSocialStudent(SubLevel $sublevel,  $student)
    {
        $studentDetail = Student::find($student);

        $socials = SocialPeriod::where('semester_id', YearHelper::thisSemester()->id)
                        ->where('level_id', $sublevel->level_id)
                        ->get();
        // dd($studentDetail);
        return view('users.teacher.nilai-sosial-siswa', compact('studentDetail', 'sublevel', 'socials'));
    }

    public function updateSocialStudent(SubLevel $sublevel,  $student, Request $request)
    {
        $maxData = count($request->socialPeriod);
        // dd($request);
        for ($i=1; $i <=$maxData; $i++) { 
            if ($request->socialscore[$i]) {
                $createScoreSocial = ScoreSocialStudent::updateOrCreate(
                    ['social_period_id' => $request->socialPeriod[$i],
                     'student_id' => $student],
                    ['score' => $request->socialscore[$i]]
                );
            } else{
                $delete = DB::table('score_social_students')->where('social_period_id', $request->socialPeriod[$i])
                                                ->where('student_id', $student)
                                                ->delete();
            }
        }

        return redirect('/subLevelId=' . $sublevel->id . '/studentId=' . $student . '/penilaian/sosial')->with('status','Nilai Sosial Berhasil Diisi');
    }

    public function ekstrakurikuler(SubLevel $sublevel)
    {
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $sublevelstudents = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('sub_level_students.sub_level_id',$sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->select('sub_level_students.id','students.nama','level_students.student_id')
                        ->paginate(10);
        
        $extracurriculars = Extracurricular::all();
        $converts = Convert::all();

        // dd($converts[0]->nilai_huruf);
                        // dd($sublevelstudents);
        return view('users.teacher.extrakurikuler', compact('students','sublevel','sublevelstudents','extracurriculars','converts'));
    }

    public function storeExtraStudent(SubLevel $sublevel, Request $request)
    {
        // dd($request);
        $extraStudent = $request->extraValueIdModal ? 
                            DB::table('extracurricular_period_scores')->where('id', $request->extraValueIdModal )
                                                                      ->update(['extracurricular_id' => $request->inputExtraModal,
                                                                                'convert_id' => $request->inputScoreExtraModal])
                        :
                            DB::table('extracurricular_period_scores')->insert([
                                'semester_id' => YearHelper::thisSemester()->id,
                                'extracurricular_id' => $request->inputExtraModal,
                                'student_id' => $request->studentInputExtraModal,
                                'convert_id' => $request->inputScoreExtraModal
                            ])
                        ;
        return redirect('/subLevelId=' . $sublevel->id . '/ekstrakurikuler' . $request->page);
    }

    public function saran(SubLevel $sublevel)
    {
        $sublevelstudents = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('sub_level_students.sub_level_id',$sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->select('sub_level_students.id','students.nama','level_students.student_id')
                        ->paginate(10);

        return view('users.teacher.saran', compact('sublevelstudents','sublevel'));
    }

    public function storeSaran(SubLevel $sublevel, Request $request)
    {
        if ($request->inputSaran) {
            $saran = DB::table('advices')->updateOrInsert(
                ['student_id' => $request->studentInputModal,
                 'level_id' => $sublevel->level_id,
                 'semester_id' => YearHelper::thisSemester()->id],
                 ['saran' => $request->inputSaran]
            );
        }
        
        return redirect('/subLevelId=' . $sublevel->id . '/saran' . $request->page);
    }

    public function ketidakhadiran(SubLevel $sublevel)
    {
        $sublevelstudents = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('sub_level_students.sub_level_id',$sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->select('sub_level_students.id','students.nama','level_students.student_id')
                        ->paginate(10);

        return view('users.teacher.ketidakhadiran', compact('sublevelstudents','sublevel'));
    }

    public function storeKetidakhadiran(SubLevel $sublevel, Request $request)
    {
        $absent = DB::table('absents')->updateOrInsert(
            ['student_id' => $request->studentInputModal,
             'level_id' => $sublevel->level_id,
             'semester_id' => YearHelper::thisSemester()->id],
             ['sakit' => $request->inputSakit,
              'izin' => $request->inputIzin,
              'tanpa_keterangan' => $request->inputAlfa,
             ]
        );

        return redirect('/subLevelId=' . $sublevel->id . '/ketidakhadiran' . $request->page);
    }

    public function printLastSemesterReport(SubLevel $sublevel)
    {
        $studentperiods = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->select('level_students.student_id','students.nama','students.nisn','students.no_induk')
                        ->get();

        $levelsubjects = DB::table('level_subjects')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_subjects.level_id',$sublevel->level_id)
                            ->where('level_subjects.semester_id',YearHelper::thisSemester()->id)
                            ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of')
                            ->get();

        $socialperiods = DB::table('social_periods')
                            ->join('socials','socials.id','=','social_periods.social_id')
                            ->where('social_periods.level_id',$sublevel->level_id)
                            ->where('social_periods.semester_id',YearHelper::thisSemester()->id)
                            ->get();
    
        $spiritualperiods = DB::table('spiritual_periods')
                            ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                            ->where('spiritual_periods.level_id',$sublevel->level_id)
                            ->where('spiritual_periods.semester_id',YearHelper::thisSemester()->id)
                            ->get();
        //jumlahkan nilai Pengetahuan
        $jumlahNilaiPengetahuanSiswa = [];
        $jumlahMapel = [];
        $rata2PerSiswa = [];

        $index = 0;

        foreach ($studentperiods as $studentperiod) {
            $jumlahMapel[$index] = 0;
            $totalNilaiPengetahuan = 0;

            foreach ($levelsubjects as $levelsubject) {
                $totalNilaiPengetahuan += ScoreHelper::reportScorePerSubject($studentperiod->student_id,$levelsubject->id);
                $jumlahNilaiPengetahuanSiswa[$index] = [
                    "id" => $studentperiod->student_id,
                    "nama" => $studentperiod->nama,
                    "jumlahNilaiPengetahuan" => $totalNilaiPengetahuan
                ];
                $jumlahMapel[$index]++;
                
            }
            $index++;
        }

        //jumlahkan nilai Keterampilan
        $jumlahNilaiKeterampilanSiswa = [];

        $index = 0;

        foreach ($studentperiods as $studentperiod) 
        {
            $totalNilaiKeterampilan = 0;
            foreach ($levelsubjects as $levelsubject) 
            {
                $totalNilaiKeterampilan += ScoreHelper::avgPracticeScore($studentperiod->student_id,$levelsubject->id);
                $jumlahNilaiKeterampilanSiswa[$index] = [
                    "id" => $studentperiod->student_id,
                    "nama" => $studentperiod->nama,
                    "jumlahNilaiKeterampilan" => $totalNilaiKeterampilan
                ];
                $jumlahMapel[$index]++;
            }
            $index++;
        }

        // jumlah nilai keterampilan dan pengetahuan
        
        $jumlahSemuaNilai = [];
        $index=0;
        foreach ($studentperiods as $studentperiod) {
            $temp = 0;
            $temp = $jumlahNilaiPengetahuanSiswa[$index]["jumlahNilaiPengetahuan"] + $jumlahNilaiKeterampilanSiswa[$index]["jumlahNilaiKeterampilan"];

            $jumlahSemuaNilai[$index] = [
                "id" => $studentperiod->student_id,
                "jumlahNilai" => $temp,
                "rata2" => $temp/$jumlahMapel[$index]
            ];
            $index++;

        }

        //mengurutkan dan memberikan ranking
        $ranking = [];
        
        //urutkan atau berikan ranking secara default
        for ($i=0; $i < count($studentperiods); $i++) { 
            $ranking[$i] = [
                'id' => $jumlahSemuaNilai[$i]['id'],
                'nilai' => $jumlahSemuaNilai[$i]['jumlahNilai'],
                'ranking' => $i+1
            ];
        }

        //mengurutkan ranking
        for ($i=0; $i < count($studentperiods); $i++) { 
            $tempid = 0;
            $tempnilai = 0;

            for ($j=0; $j < count($studentperiods)-1; $j++) { 
                if ($ranking[$j]["nilai"] < $ranking[$j+1]["nilai"]) {
                    $tempid = $ranking[$j+1]["id"];
                    $tempnilai = $ranking[$j+1]["nilai"];

                    $ranking[$j+1]["id"] = $ranking[$j]["id"];
                    $ranking[$j+1]["nilai"] = $ranking[$j]["nilai"];

                    $ranking[$j]["id"] = $tempid;
                    $ranking[$j]["nilai"] = $tempnilai;
                }
            }
        }

        //masukkan ranking ke database
        for ($i=0; $i < count($ranking); $i++) { 
            $rank = Rank:: updateOrCreate(
                ['student_id' => $ranking[$i]['id'], 
                 'semester_id' => YearHelper::thisSemester()->id],
                ['rank' => $ranking[$i]['ranking']]
            );
        }

        return view('users.teacher.view-last-report', compact('sublevel','studentperiods','levelsubjects', 'socialperiods','spiritualperiods'));
    }

    public function printLastSemesterReportCover($sublevelid, $student)
    {
        $sublevel = SubLevel::find($sublevelid);
        $student = Student::find($student);
        
        $teacher = DB::table('staff_periods')
                    ->join('positions','positions.id','=','staff_periods.position_id')
                    ->join('staff','staff_periods.staff_id','=','staff.id')
                    ->where('positions.jabatan',"KEPALA SEKOLAH")
                    ->select('staff.nama','staff.nik')
                    ->first();

        $converts = Convert::all();
        $school = School::first();
        $pdf = PDF::loadView('reports.cover',['student' => $student, 'school'=>$school, 'converts' => $converts, 'teacher' => $teacher]);
        return $pdf->download('cover-raport-'.$student->nama.'.pdf');
    }

    public function printLastSemesterReportScore(SubLevel $sublevel, Student $student)
    {
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
        $school = School::first();

        $socialperiods = DB::table('social_periods')
                        ->join('socials','socials.id','=','social_periods.social_id')
                        ->where('social_periods.level_id',$sublevel->level_id)
                        ->where('social_periods.semester_id',$semester->id)
                        ->get();

        $spiritualperiods = DB::table('spiritual_periods')
                        ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                        ->where('spiritual_periods.level_id',$sublevel->level_id)
                        ->where('spiritual_periods.semester_id',$semester->id)
                        ->get();

        $predikatsocial = konversiNilai(avSocialScore($student->id, $socialperiods),"predikat");
        $predikatspiritual = konversiNilai(avSpiritualScore($student->id, $spiritualperiods),"predikat");

        $levelsubjects = DB::table('level_subjects')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_subjects.level_id',$sublevel->level_id)
                            ->where('level_subjects.semester_id',$semester->id)
                            ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of','level_subjects.kkm')
                            ->get();

        $jumlahNilaiPengetahuanSiswa = [];
        $i = 0;

        foreach ($levelsubjects as $levelsubject) {
            $jumlahNilaiPengetahuanSiswa[$i++] =[
                "id" => $levelsubject->id,
                "mapel" => $levelsubject->mata_pelajaran,
                "kategori" => $levelsubject->kategori,
                "sub_of" => $levelsubject->sub_of, 
                "nilaipengetahuan" => round(ScoreHelper::reportScorePerSubject($student->id,$levelsubject->id)),
                "nilaihurufpengetahuan" => konversiNilai(ScoreHelper::reportScorePerSubject($student->id,$levelsubject->id),'nilai')->nilai_huruf,
                "nilaiketerampilan" => round(ScoreHelper::avgPracticeScore($student->id,$levelsubject->id)),
                "nilaihurufketerampilan" => konversiNilai(ScoreHelper::avgPracticeScore($student->id,$levelsubject->id),'nilai')->nilai_huruf,
                "kkm" => $levelsubject->kkm,
            ];
        }

        $rank = DB::table('ranks')
                    ->where('student_id', $student->id)
                    ->where('semester_id', $semester->id)
                    ->first();

        $jumlahSiswa = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('level_students.level_id',$sublevel->level->id)
                        ->where('level_students.year_id',$semester->year->id)
                        ->where('sub_level_students.sub_level_id',$sublevel->id)
                        ->count();

        $uplevel = DB::table('up_levels')
                        ->where('student_id',$student->id)
                        ->where('semester_id',$semester->id)
                        ->first();

        $teacher = DB::table('home_room_teachers')
                        ->join('staff','staff.id','=','home_room_teachers.staff_id')
                        ->where('home_room_teachers.sub_level_id',$sublevel->id)
                        ->where('home_room_teachers.year_id',$semester->year->id)
                        ->select('staff.nama','staff.nik')
                        ->first();

        $kepalasekolah = DB::table('staff_periods')
                    ->join('positions','positions.id','=','staff_periods.position_id')
                    ->join('staff','staff_periods.staff_id','=','staff.id')
                    ->where('positions.jabatan',"KEPALA SEKOLAH")
                    ->select('staff.nama','staff.nik')
                    ->first();

        $pdf = PDF::loadView('reports.score',['student' => $student, 'school'=>$school, 'kepalasekolah' => $kepalasekolah, 'semester' => $semester, 'sublevel' => $sublevel, 'predikatsocial' => $predikatsocial, 'predikatspiritual' => $predikatspiritual, 'jumlahNilaiPengetahuanSiswa' => $jumlahNilaiPengetahuanSiswa, 'levelsubjects' => $levelsubjects, 'rank' => $rank, 'jumlahSiswa' => $jumlahSiswa, 'uplevel' => $uplevel, 'teacher' => $teacher]);
        return $pdf->download('nilai-raport-'.$student->nama.'.pdf');
    }

    public function printLastSemesterReportDescription(SubLevel $sublevel, Student $student)
    {
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
        $school = School::first();

        $spiritual = DB::table('score_spiritual_students')
                    ->join('spiritual_periods','spiritual_periods.id','=','score_spiritual_students.spiritual_period_id')
                    ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                    ->where('score_spiritual_students.student_id',$student->id)
                    ->where('spiritual_periods.semester_id',$semester->id)
                    ->where('spiritual_periods.level_id',$sublevel->level_id)
                    ->select('score_spiritual_students.*','spirituals.aspek')
                    ->get();
                    
        $social = DB::table('score_social_students')
                    ->join('social_periods','social_periods.id','=','score_social_students.social_period_id')
                    ->join('socials','socials.id','=','social_periods.social_id')
                    ->where('score_social_students.student_id',$student->id)
                    ->where('social_periods.semester_id',$semester->id)
                    ->where('social_periods.level_id',$sublevel->level->id)
                    ->select('socials.aspek','score_social_students.score')
                    ->get();
                
        $levelSubjects = DB::table('level_subjects')
                        ->join('subjects','subjects.id','=','level_subjects.subject_id')
                        ->where('level_subjects.semester_id',$semester->id)
                        ->where('level_subjects.level_id',$sublevel->level->id)
                        ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of')
                        ->get();
                        
        $ekstrakurikuler = DB::table('extracurricular_period_scores')
                            ->join('extracurriculars','extracurriculars.id','=','extracurricular_period_scores.extracurricular_id')
                            ->join('converts','converts.id','=','extracurricular_period_scores.convert_id')
                            ->where('extracurricular_period_scores.student_id',$student->id)
                            ->where('extracurricular_period_scores.semester_id',$semester->id)
                            ->select('extracurriculars.nama','converts.nilai_huruf')
                            ->get();

        $advice = DB::table('advices')
                    ->where('semester_id',$semester->id)
                    ->where('student_id',$student->id)
                    ->first();

        $absent = DB::table('absents')
                    ->where('semester_id',$semester->id)
                    ->where('student_id',$student->id)
                    ->where('level_id',$sublevel->level->id)
                    ->first();
        // dd($advice);

        $uplevel = DB::table('up_levels')
                        ->where('student_id',$student->id)
                        ->where('semester_id',$semester->id)
                        ->first();

        $teacher = DB::table('home_room_teachers')
                        ->join('staff','staff.id','=','home_room_teachers.staff_id')
                        ->where('home_room_teachers.sub_level_id',$sublevel->id)
                        ->where('home_room_teachers.year_id',$semester->year->id)
                        ->select('staff.nama','staff.nik')
                        ->first();

        $kepalasekolah = DB::table('staff_periods')
                    ->join('positions','positions.id','=','staff_periods.position_id')
                    ->join('staff','staff_periods.staff_id','=','staff.id')
                    ->where('positions.jabatan',"KEPALA SEKOLAH")
                    ->select('staff.nama','staff.nik')
                    ->first();

        $pdf = PDF::loadView('reports.description',['semester' => $semester, 'school' => $school, 'social' => $social, 'spiritual' => $spiritual, 'student' => $student, 'sublevel' => $sublevel, 'teacher' => $teacher, 'kepalasekolah' => $kepalasekolah, 'uplevel' =>$uplevel, 'levelSubjects' =>$levelSubjects, 'ekstrakurikuler' =>$ekstrakurikuler, 'advice' =>$advice, 'absent' => $absent]);
        return $pdf->download('nilai-raport-'.$student->nama.'.pdf');
    }

    public function exportScoreToExcel(SubLevel $sublevel)
    {
        return Excel::download(new RekapRaport(), 'rekap-nilai.xlsx');
    }
}
