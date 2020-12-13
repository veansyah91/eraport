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

class RekapRaport implements FromView
{

    public function view(): View
    {
        $semesters = Semester::all(); 
        $semester = last(last($semesters));

        $studentperiods = DB::table('level_students')
                            ->join('students','students.id','=','level_students.student_id')
                            ->join('sub_level_students','sub_level_students.level_student_id','=','level_students.id')
                            ->where('level_students.level_id',$level->id)
                            ->where('level_students.year_id',$semester->year_id)
                            ->select('students.id','students.nama','sub_level_students.sub_level_id')
                            ->get();

        $sublevels = DB::table('sub_levels')
                    ->where('level_id',$level->id)
                    ->get();

        $socialperiods = DB::table('social_periods')
                        ->join('socials','socials.id','=','social_periods.social_id')
                        ->where('social_periods.level_id',$level->id)
                        ->where('social_periods.semester_id',$semester->id)
                        ->get();

        $spiritualperiods = DB::table('spiritual_periods')
                        ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                        ->where('spiritual_periods.level_id',$level->id)
                        ->where('spiritual_periods.semester_id',$semester->id)
                        ->get();
        
        $levelsubjects = DB::table('level_subjects')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_subjects.level_id',$level->id)
                            ->where('level_subjects.semester_id',$semester->id)
                            ->select('level_subjects.id','subjects.kategori','subjects.mata_pelajaran','subjects.sub_of')
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
                $totalNilaiPengetahuan += avKnowledge($studentperiod->id,$levelsubject->id);
                $jumlahNilaiPengetahuanSiswa[$index] = [
                    "id" => $studentperiod->id,
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
                $totalNilaiKeterampilan += avPractice($studentperiod->id,$levelsubject->id);
                $jumlahNilaiKeterampilanSiswa[$index] = [
                    "id" => $studentperiod->id,
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
                "id" => $studentperiod->id,
                "jumlahNilai" => $temp,
                "rata2" => $temp/$jumlahMapel[$index]
            ];
            $index++;

        }

        //mengurutkan dan memberikan ranking
        $rangking = [];
        
        //urutkan atau berikan rangking secara default
        for ($i=0; $i < count($studentperiods); $i++) { 
            $rangking[$i] = [
                'id' => $jumlahSemuaNilai[$i]['id'],
                'nilai' => $jumlahSemuaNilai[$i]['jumlahNilai'],
                'rangking' => $i+1
            ];
        }

        //mengurutkan rangking
        for ($i=0; $i < count($studentperiods); $i++) { 
            $tempid = 0;
            $tempnilai = 0;

            for ($j=0; $j < count($studentperiods)-1; $j++) { 
                if ($rangking[$j]["nilai"] < $rangking[$j+1]["nilai"]) {
                    $tempid = $rangking[$j+1]["id"];
                    $tempnilai = $rangking[$j+1]["nilai"];

                    $rangking[$j+1]["id"] = $rangking[$j]["id"];
                    $rangking[$j+1]["nilai"] = $rangking[$j]["nilai"];

                    $rangking[$j]["id"] = $tempid;
                    $rangking[$j]["nilai"] = $tempnilai;
                }
            }
        }

        //masukkan rangking ke database
        for ($i=0; $i < count($rangking); $i++) { 
            $rank = Rank:: updateOrCreate(
                ['student_id' => $rangking[$i]['id'], 
                 'semester_id' => $semester->id],
                ['rank' => $rangking[$i]['rangking']]
            );
        }

        return view('exports.rekap-raport', compact('semester', 'levelsubjects', 'studentperiod'));
    }
}
