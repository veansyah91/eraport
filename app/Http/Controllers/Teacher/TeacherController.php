<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\LevelSubject;
use App\Helpers\YearHelper;
use App\Helpers\ScoreHelper;
use App\SubLevel;
use App\KnowledgeBaseCompetence;
use App\PracticeBaseCompetence;
use App\ScoreRatio;
use App\Student;
use App\Semester;
use App\School;
use App\SubLevelStudent;
use App\Rank;
use PDF;

class TeacherController extends Controller
{
    public function index(SubLevel $sublevel, LevelSubject $levelsubject){

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

    public function createKnowledgeScore(Request $request, SubLevel $sublevel, KnowledgeBaseCompetence $knowledge, ScoreRatio $scoreratio, Student $student){
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

    public function urlTest(LevelSubject $levelsubject){
        $urlMidTest = DB::table('url_subject_tests')
                            ->where('level_subject_id', $levelsubject->id)
                            ->where('kategori','Tengah Semester')
                            ->first();

        $urlLastTest = DB::table('url_subject_tests')
                            ->where('level_subject_id', $levelsubject->id)
                            ->where('kategori','Akhir Semester')
                            ->first();
        return view('users.teacher.test-schedule', compact('levelsubject','urlMidTest','urlLastTest'));
    }

    public function setUrlTest(Request $request, LevelSubject $levelsubject){
        $urlTest = DB::table('url_subject_tests')
                    ->updateOrInsert(
                        ['level_subject_id' => $levelsubject->id,
                        'kategori' => $request->kategori],
                        ['url' => $request->url]
                    );

        return redirect('/jadwal-ujian/levelsubjectid=' . $levelsubject->id)->with('status','URL Ujian Mata Pelajaran' . $levelsubject->subject->mata_pelajaran . 'Berhasil Diatur'); 
    }

    public function printMidSemesterReport(SubLevel $sublevel, Semester $semester){
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
                'nilai' => ScoreHelper::rataMasingScoreMid($student->student_id, $semester->id),
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
