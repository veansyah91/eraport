<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Convert;
use App\Level;
use App\Rank;
use App\School;
use App\Semester;
use App\Student;
use App\SubLevel;
use Illuminate\Support\Facades\DB;
use PDF;


class RaportController extends Controller
{
    public function index(Level $level)
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
        

        return view('reports.index',compact('level','sublevels','semester','studentperiods','spiritualperiods','socialperiods','levelsubjects'));
    }

    public function printCover($sublevelid, $student){
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

    public function printScore(SubLevel $sublevel, Student $student){
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
                "nilaipengetahuan" => round(avKnowledge($student->id,$levelsubject->id)),
                "nilaihurufpengetahuan" => konversiNilai(avKnowledge($student->id,$levelsubject->id),'nilai')->nilai_huruf,
                "nilaiketerampilan" => round(avPractice($student->id,$levelsubject->id)),
                "nilaihurufketerampilan" => konversiNilai(avPractice($student->id,$levelsubject->id),'nilai')->nilai_huruf,
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

    public function printDescription(SubLevel $sublevel, Student $student){
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


        // dd(descPractice(15,41,$semester->id)) ;
        // dd(descCompetence(15,41,$semester->id));
        // dd(avKnowledge(15,41));
        // dd($student->id);
        // dd($levelSubjects);

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
}
