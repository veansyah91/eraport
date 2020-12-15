<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

use App\Convert;
use App\Level;
use App\Rank;
use App\School;
use App\Semester;
use App\Student;
use App\SubLevel;

use App\Helpers\YearHelper;
use App\Helpers\TeacherHelper;
use App\Helpers\ScoreHelper;

class RekapRaport implements FromView
{

    public function view(): View
    {
        $sublevel = TeacherHelper::getHomeRoom()->sub_level_id;

        $semesters = Semester::all(); 
        $semester = last(last($semesters));

        $studentperiods = DB::table('sub_level_students')
                        ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                        ->join('students','students.id','=','level_students.student_id')
                        ->where('level_students.year_id', YearHelper::thisSemester()->year_id)
                        ->where('sub_level_students.sub_level_id', $sublevel)
                        ->select('level_students.student_id','students.nama','students.nisn','students.no_induk')
                        ->get();

        $sublevelDetail = SubLevel::find($sublevel);

        $levelsubjects = DB::table('level_subjects')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_subjects.level_id',$sublevelDetail ->level_id)
                            ->where('level_subjects.semester_id',YearHelper::thisSemester()->id)
                            ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of')
                            ->get();

        $socialperiods = DB::table('social_periods')
                            ->join('socials','socials.id','=','social_periods.social_id')
                            ->where('social_periods.level_id',$sublevelDetail ->level_id)
                            ->where('social_periods.semester_id',YearHelper::thisSemester()->id)
                            ->get();
    
        $spiritualperiods = DB::table('spiritual_periods')
                            ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                            ->where('spiritual_periods.level_id',$sublevelDetail ->level_id)
                            ->where('spiritual_periods.semester_id',YearHelper::thisSemester()->id)
                            ->get();

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

        return view('exports.rekap-raport',[
            'semester' => $semester,
            'levelsubjects' => $levelsubjects,
            'studentperiods' => $studentperiods,
            'spiritualperiods' => $spiritualperiods,
            'socialperiods' => $socialperiods
        ] );
    }
}
