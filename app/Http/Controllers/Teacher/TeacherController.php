<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LevelSubject;
use App\Helpers\YearHelper;
use App\SubLevel;
use App\KnowledgeBaseCompetence;
use App\PracticeBaseCompetence;
use App\ScoreRatio;
use App\Student;

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

        $ratio = ScoreRatio::all();

        return view('users.teacher.index',compact('sublevel','levelsubject','students','kompetensidasar','praktekkompetensidasar','sublevelstudents','knowledgebasecompetences','practicebasecompetences','ratio'));
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

        $scores = DB::table('score_knowlegde_competences')
                    ->updateOrInsert(
                        ['knowledge_base_competence_id' => $knowledge->id, 'student_id' => $student->id, 'score_ratio_id' => $scoreratio->id],
                        ['score' => $request->score]
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
}
