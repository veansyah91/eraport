<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\LevelSubject;
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
use App\School;
use App\SubLevelStudent;
use App\UrlThemeTest;
use App\ThemeSubject;
use App\ThemeTest;
use App\Question;
use App\Rank;

use PDF;
use File;

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

    public function knowledgeScore(SubLevel $sublevel, LevelSubject $levelsubject){
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $kompetensidasar = DB::table('knowledge_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();

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
        return view('users.teacher.nilai-pengetahuan', compact('sublevel','levelsubject','students','kompetensidasar','sublevelstudents','basecompetences','ratio'));
    }

    public function createKnowledgeScore(Request $request, SubLevel $sublevel, KnowledgeBaseCompetence $knowledge, ScoreRatio $scoreratio, Student $student)
    {
        $score = 0;
        
        if ($request->score) {
            $score = $request->score;
        }
        $scores = DB::table('score_knowlegde_competences')
                    ->updateOrInsert(
                        ['knowledge_base_competence_id' => $knowledge->id, 'student_id' => $student->id, 'score_ratio_id' => $scoreratio->id],
                        ['score' => $score]
                    );

        return redirect('penilaian/' . $sublevel->id . '/' . $knowledge->level_subject_id . '/nilai-pengetahuan')->with('status','Nilai Pengetahuan Berhasil Diatur'); 
    }

    public function practiceScore(SubLevel $sublevel, LevelSubject $levelsubject){
        $students = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->where('sub_level_students.sub_level_id', $sublevel->id)
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->get();

        $praktekkompetensidasar = DB::table('practice_base_competences')
                        ->where('level_subject_id', $levelsubject->id)
                        ->get();

        $basecompetences = DB::table('practice_base_competences')
                            ->where('level_subject_id', $levelsubject->id)
                            ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('sub_level_students.sub_level_id',$sublevel->id)
                                ->select('sub_level_students.id','students.nama','level_students.student_id')
                                ->get();

        $ratio = ScoreRatio::all();
        return view('users.teacher.nilai-keterampilan', compact('sublevel','levelsubject','students','praktekkompetensidasar','sublevelstudents','basecompetences','ratio'));
    }

    public function createPracticeScore(Request $request, SubLevel $sublevel, PracticeBaseCompetence $practice, Student $student)
    {
        if ($request->praktek) {
            // dd($student);

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

        $pdf = PDF::loadView('users.teacher.test-print',['school' => $school, 'levelsubject' => $levelsubject, 'scoreratio' => $scoreratio, 'questions' => $questions]);
        return $pdf->download('test-' . $levelsubject->subject->mata_pelajaran . '-kelas-' . $levelsubject->level->kelas . '-' . $scoreratio->period . '.pdf');
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
        return $pdf->download('theme-test-' . $themesubject->tema . '-kelas-' . $themesubject->level->kelas . '-' . $scoreratio->period . '.pdf');
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
        dd($request);
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
        $question->number = $request->number;

        $question->answer_type = $request->objective == "on" ? 'objective' : 'essay';
        $question->number_of_answers = $request->objective == "on" ? $request->jumlahjawaban : 1;
        $question->save();

        if ($request->objective == 'on') {
            for ($i=0; $i < $request->jumlahjawaban; $i++) { 
                if ($request->answer[$i]) {
                    $answer = new ObjectiveAnswer;
                    $answer->question_id = $question->id;
                    $answer->detail = $request->answer[$i];
                    $answer->save();
                }
            }
        }

        return redirect('/ujian/levelsubjectid=' . $levelsubject->id . '/periodid=' . $scoreratio->id . '/create')->with('status','Soal Ujian Mata Pelajaran' . $levelsubject->subject->mata_pelajaran . 'Berhasil Diatur');
    }

    public function updateNumber(Question $question, Request $request)
    {
        $updateNumber = Question::where('id', $question->id)->update([
            'number' => $request->number
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

    public function deleteQuestion(Question $question)
    {
        // cek apakah ada gambar
        if ($question->image) {
            File::delete('img/test/'.$question->image);
        }
        Question::destroy($question->id);

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

    public function updateAnswerOption(Question $question, Request $request)
    {
        if ($request->answerId) {
            $answer = ObjectiveAnswer::where('id', $request->answerId)->update([
                    'detail' => $request->answerDetail
            ]);
        } else{
            if ($request->answerDetail) {
                $answer = ObjectiveAnswer::create([
                        'question_id' => $question->id,
                        'detail' => $request->answerDetail
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
            'semester_id' => $semester->id,
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
        $question->number = $request->number;

        $question->answer_type = $request->objective == "on" ? 'objective' : 'essay';
        $question->number_of_answers = $request->objective == "on" ? $request->jumlahjawaban : 1;
        $question->save();

        if ($request->objective == 'on') {
            for ($i=0; $i < $request->jumlahjawaban; $i++) { 
                if ($request->answer[$i]) {
                    $answer = new ObjectiveAnswer;
                    $answer->question_id = $question->id;
                    $answer->detail = $request->answer[$i];
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
        
        return view('users.teacher.print-mid-report', compact('students','sublevel','semester'));
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

    
}
