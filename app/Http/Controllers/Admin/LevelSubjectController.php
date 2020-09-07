<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LevelSubject;
use App\KnowledgeBaseCompetence;
use App\PracticeBaseCompetence;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LevelSubjectController extends Controller
{

    public function index(LevelSubject $levelsubject)
    {
        $kompetensidasar = DB::table('knowledge_base_competences')
                            ->where('level_subject_id',$levelsubject->id)
                            ->get();
        $praktekkompetensidasar = DB::table('practice_base_competences')
                            ->where('level_subject_id',$levelsubject->id)
                            ->get();

        return view('levelsubject.index',compact('levelsubject','kompetensidasar','praktekkompetensidasar'));
    }

    public function update(Request $request, LevelSubject $levelsubject)
    {
        LevelSubject::where('id',$levelsubject->id)
                    ->update([
                        'kkm' => $request->kkm
                    ]);
        return redirect('/classes/'.$levelsubject->level_id)->with('status','KKM Berhasil Diubah');
    }

    public function storeKnowledgeCompetence(Request $request, LevelSubject $levelsubject)
    {
        $kd = new KnowledgeBaseCompetence;
        $kd->level_subject_id = $levelsubject->id;
        $kd->pengetahuan_kompetensi_dasar = $request->kd;
        $kd->kode = $request->kode;
        $kd->save();

        return redirect('/levelsubject/'.$levelsubject->id)->with('status','Kompetensi Dasar Berhasil Ditambahkan');
    }

    public function deleteKnowledgeCompetence(Request $request, KnowledgeBaseCompetence $knowledgebasecompetence)
    {
        KnowledgeBaseCompetence::destroy($knowledgebasecompetence->id);

        return redirect('/levelsubject/'.$knowledgebasecompetence->levelSubject->id)->with('status','Kompetensi Dasar Berhasil Dihapus');
    }

    public function updateKnowledgeCompetence(Request $request, KnowledgeBaseCompetence $knowledgebasecompetence)
    {
        KnowledgeBaseCompetence::where('id',$knowledgebasecompetence->id)
                                ->update([
                                    'kode' => $request->kode,
                                    'pengetahuan_kompetensi_dasar' => $request->kd,
                                ]);

        return redirect('/levelsubject/'.$knowledgebasecompetence->levelSubject->id)->with('status','Kompetensi Dasar Berhasil Diubah');
    }

    public function storePracticeCompetence(Request $request, LevelSubject $levelsubject)
    {
        $kd = new PracticeBaseCompetence;
        $kd->level_subject_id = $levelsubject->id;
        $kd->keterampilan_kompetensi_dasar = $request->kd;
        $kd->kode = $request->kode;
        $kd->save();

        return redirect('/levelsubject/'.$levelsubject->id)->with('status','Kompetensi Dasar Berhasil Ditambahkan');
    }

    public function deletePracticeCompetence(Request $request, PracticeBaseCompetence $practicebasecompetence)
    {
        PracticeBaseCompetence::destroy($practicebasecompetence->id);

        return redirect('/levelsubject/'.$practicebasecompetence->levelSubject->id)->with('status','Kompetensi Dasar Berhasil Dihapus');
    }

    public function updatePracticeCompetence(Request $request, PracticeBaseCompetence $practicebasecompetence)
    {
        PracticeBaseCompetence::where('id',$practicebasecompetence->id)
                                ->update([
                                    'kode' => $request->kode,
                                    'keterampilan_kompetensi_dasar' => $request->kd,
                                ]);

        return redirect('/levelsubject/'.$practicebasecompetence->levelSubject->id)->with('status','Kompetensi Dasar Berhasil Diubah');
    }

}
