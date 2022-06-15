<?php

use Illuminate\Support\Facades\DB;
use App\StaffPeriod;
use App\ScoreRatio;
use App\Year;
use App\Semester;
use App\Convert;
use App\User;
use App\EntryPayment;
use App\CreditPayment;
use App\MonthlyPayment;
use App\CreditMonthlyPayment;
use App\LevelStudent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


function checkyear()
{
    $year = Year::get()->last();

    if ($year) {
        $semesters = DB::table('semesters')
                        ->where('year_id','=',$year->id)
                        ->get();
        $semester = last(last($semesters));
    }
    
    $after = year()+1;
    if (!$year||$year->awal <> year()){
        DB::table('years')->insertOrIgnore([
            ['awal' => year(), 'akhir' => year()+1,'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
        ]);

        $years = DB::table('years')->get();
        $year = last(last($years));

        DB::table('semesters')->insertOrIgnore([
            ['year_id' => $year->id, 'semester' => "GANJIL",'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
        ]);

    } elseif (!$semester||$semester->semester <> semester()) {
        $years = Year::all();
        $year = last(last($years));

        $semester = new Semester;
        $semester->year_id = $year->id;
        $semester->semester = "GENAP";
        $semester->save();
    };

}

function year()
{
    $bulan_ajar = date('m');
    if ($bulan_ajar < 7)
    {
        $tahun_ajar = date('Y')-1;
    }else{
        $tahun_ajar = date('Y');
    }    
    return $tahun_ajar;
}

function semester()
{
    $bulan_ajar = date('m');
    if ($bulan_ajar < 7)
    {
        return $semester = "GENAP";
    }else{
        return $semester = "GANJIL";
    }
}

function kelas()
{
    $kelas = DB::table('levels')->get();
    return $kelas;
}

function subkelas($idlevel)
{
    $subkelas = DB::table('sub_levels')->where('level_id', $idlevel)->get();
    return $subkelas;
}

function subKelasSiswa($id)
{
    $subkelassiswa = DB::table('sub_level_students')
                        ->join('sub_levels','sub_levels.id','=','sub_level_students.sub_level_id')
                        ->where('level_student_id',$id)
                        ->select('sub_level_students.*','sub_levels.alias')
                        ->first();

    return $subkelassiswa;

    
}

function teacher($id)
{
    $staff_teacher = DB::table('staff')
                        ->where('id',$id)
                        ->first();

    return $staff_teacher->nama;
}

function levelsubjectteacher($levelsucject,$sublevel)
{
    return $levelsubjectteacher = DB::table('level_subject_teachers')
                                ->join('staff','staff.id','=','level_subject_teachers.staff_id')
                                ->where('level_subject_teachers.level_subject_id',$levelsucject)
                                ->where('level_subject_teachers.sub_level_id',$sublevel)
                                ->select('level_subject_teachers.id','level_subject_teachers.staff_id','staff.nama')
                                ->get();
}

function socialScore($student,$social)
{
    $score = DB::table('score_social_students')
                ->where('student_id',$student)
                ->where('social_period_id',$social)
                ->first();

    return $score;
    
}

function spiritualScore($student,$spiritual)
{
    $score = DB::table('score_spiritual_students')
                ->where('student_id',$student)
                ->where('spiritual_period_id',$spiritual)
                ->first();

    return $score;
    
}

function konversiNilai($nilai,$status)
{    
    
    $converts = Convert::all();
    if ($status == "predikat") {
        if (!$nilai){
            return "Nilai Belum Diatur";
        }
        
        for ($i=0; $i < count($converts); $i++) {
            if ($i==count($converts)-1) {
                return $converts[count($converts)-1];
            }
            if ($converts[$i]->predikat >= $nilai && $converts[$i+1]->predikat < $nilai) {
                return $converts[$i];
            }
        }
    } elseif($status == "nilai") {

        for ($i=0; $i < count($converts); $i++) { 

            if ($converts[$i]->nilai_atas >= round($nilai) && $converts[$i]->nilai_bawah <= round($nilai)) {
                return $converts[$i];

            }
        }
    }
    
}

function knowledgeScore($student,$period,$kd){
    return $score = DB::table('score_knowlegde_competences')
                ->where('knowledge_base_competence_id',$kd)
                ->where('student_id',$student)
                ->where('score_ratio_id',$period)
                ->first();
}

// Rata2 NIlai Raport Berdasarkan Persentase
function rataNilai($student, $levelSubject){
    $periods = ScoreRatio::all();
    $nilairaport= 0;

    foreach ($periods as $period) {
            $nilaiPerPeriod = DB::table('score_knowlegde_competences')
                                ->join('knowledge_base_competences','knowledge_base_competences.id','=','score_knowlegde_competences.knowledge_base_competence_id')
                                ->where('score_knowlegde_competences.student_id', $student)
                                ->where('score_knowlegde_competences.score_ratio_id', $period->id)
                                ->where('knowledge_base_competences.level_subject_id', $levelSubject)
                                ->select('score')
                                ->avg('score');

            $nilairaport += $nilaiPerPeriod * $period->percent / 100;
    }

    return $nilairaport;
}

function practiceScore($student,$kd){
    return $score = DB::table('score_practice_competences')
                    ->where('practice_base_competence_id',$kd)
                    ->where('student_id',$student)
                    ->first();
}

function extracurricular($student, $semester){
    $score = DB::table('extracurricular_period_scores')
                    ->join('extracurriculars','extracurriculars.id','=','extracurricular_period_scores.extracurricular_id')
                    ->where('semester_id',$semester)
                    ->where('student_id',$student)
                    ->select('extracurricular_period_scores.id','extracurriculars.nama','extracurricular_period_scores.convert_id','extracurricular_period_scores.extracurricular_id')
                    ->get();

    return $score;
}

function convert($convert){
    return $score = DB::table('converts')
                ->where('id',$convert)
                ->first();
}

function advice($student,$level,$semester){
    return $score = DB::table('advices')
                    ->where('student_id',$student)
                    ->where('level_id',$level)
                    ->where('semester_id',$semester)
                    ->first();
}

function absent($student,$level,$semester){
    return $score = DB::table('absents')
                    ->where('student_id',$student)
                    ->where('level_id',$level)
                    ->where('semester_id',$semester)
                    ->first();
}

function Uplevel($student, $semester){
    return $status = DB::table('up_levels')
                    ->where('student_id',$student)
                    ->where('semester_id', $semester)
                    ->first();
}

function avSocialScore($student, $socialperiods){
    $totalNilai = 0;
    
    foreach ($socialperiods as $socialperiod) {
        if (socialScore($student,$socialperiod->id)) {
            $totalNilai += socialScore($student,$socialperiod->id)->score;
        }
    }

    if (count($socialperiods)>0){
        return $totalNilai/count($socialperiods);
    } else{
        return 0;
    }
    
}

function avSpiritualScore($student, $spiritualperiods){
    $totalNilai = 0;
    
    foreach ($spiritualperiods as $spiritualperiod) {

        if (spiritualScore($student,$spiritualperiod->id)) {
            $totalNilai += spiritualScore($student,$spiritualperiod->id)->score;
        }
    }

    if (count($spiritualperiods)>0){
        return $totalNilai/count($spiritualperiods);
    } else{
        return 0;
    }
    
}

function avKnowledge($student,$levelsubject)
{
    $scores = DB::table('score_knowlegde_competences')
            ->join('knowledge_base_competences','score_knowlegde_competences.knowledge_base_competence_id','=','knowledge_base_competences.id')
            ->join('score_ratios','score_knowlegde_competences.score_ratio_id','=','score_ratios.id')
            ->where('knowledge_base_competences.level_subject_id',$levelsubject)
            ->where('score_knowlegde_competences.student_id',$student)
            ->select('score_ratios.period','score_knowlegde_competences.score')
            ->get();
            
    $period = [];
    $period[0]=0;
    $period[1]=0;
    $period[2]=0;
    $index = [];
    $index[0]=0;
    $index[1]=0;
    $index[2]=0;

    foreach ($scores as $score) {
        if($score->period == "Harian" && $score->score != 0){
            $period[0] += $score->score;
            $index[0]++; 
        } elseif ($score->period == "Tengah Semester" && $score->score != 0) {
            $period[1] += $score->score;
            $index[1]++; 
        } elseif ($score->period == "Akhir Semester" && $score->score != 0) {
            $period[2] += $score->score;
            $index[2]++; 
        }
    }
    for ($i=0; $i < count($period); $i++) { 
        if ($index[$i] == 0) $period[$i] = 0;
        else $period[$i] = $period[$i]/$index[$i];
    }

    return rataNilai($student, $period);
}

function avPractice($student,$levelsubject){
    return $scores = DB::table('score_practice_competences')
                ->join('practice_base_competences','practice_base_competences.id','=','score_practice_competences.practice_base_competence_id')
                ->where('practice_base_competences.level_subject_id',$levelsubject)
                ->where('score_practice_competences.student_id',$student)
                ->avg('praktek','produk','proyek');    
}

function avPracticePerClass($levelsubject)
{
    
    $avgproduk = DB::table('score_practice_competences')
                ->join('practice_base_competences','practice_base_competences.id','=','score_practice_competences.practice_base_competence_id')
                ->where('practice_base_competences.level_subject_id',$levelsubject)
                ->where('score_practice_competences.produk','>',0)
                ->avg('score_practice_competences.produk');

    $avgproyek = DB::table('score_practice_competences')
                ->join('practice_base_competences','practice_base_competences.id','=','score_practice_competences.practice_base_competence_id')
                ->where('practice_base_competences.level_subject_id',$levelsubject)
                ->where('score_practice_competences.proyek','>',0)
                ->avg('score_practice_competences.proyek');

    $avgpraktek = DB::table('score_practice_competences')
                ->join('practice_base_competences','practice_base_competences.id','=','score_practice_competences.practice_base_competence_id')
                ->where('practice_base_competences.level_subject_id',$levelsubject)
                ->where('score_practice_competences.praktek','>',0)
                ->avg('score_practice_competences.praktek');

    

    return $scores = ($avgproduk + $avgproyek + $avgpraktek)/3;

}

function avKnowledgePerClass($levelsubject){
    return $scores = DB::table('score_knowlegde_competences')
            ->join('knowledge_base_competences','score_knowlegde_competences.knowledge_base_competence_id','=','knowledge_base_competences.id')
            ->join('score_ratios','score_knowlegde_competences.score_ratio_id','=','score_ratios.id')
            ->where('knowledge_base_competences.level_subject_id',$levelsubject)
            ->select('score_ratios.period','score_knowlegde_competences.score')
            ->avg('score_knowlegde_competences.score');

}

function ranking($student,$semester){
    return $ranking = DB::table('ranks')
                        ->where('student_id',$student)
                        ->where('semester_id',$semester)
                        ->first();                        
}

function description($student, $semester, $type, $data){
    
    $nilai = [];
    $akhir = count($data);
    for ($i=0; $i < 4; $i++) { 
        $nilai[$i]['predikat'] = '';
        $nilai[$i]['deskripsi'] = '';
    }
    // dd($data);
    if ($nilai) {
        switch ($type) {
            case 1:
                
                $i1 = 1;
                $i2 = 1;
                $i3 = 1;
                $i4 = 1;
                $i = 1;
    
                foreach ($data as $d) {
                    if ($d->score <= 4 && $d->score > 3) {
                        if ($i == 1 || $i1 == 1){
                            $nilai[0]['deskripsi'] = $nilai[0]['deskripsi'] . $d->aspek;
                        } else{
                            $nilai[0]['deskripsi'] = $nilai[0]['deskripsi'] . ', ' . $d->aspek;
                        }
                        $nilai[0]['predikat'] =konversiNilai($d->score,"predikat")->penjelasan;
                        $i++;
                        $i1++;
                    }
                    elseif ($d->score <= 3 && $d->score > 2) {
                        if ($i == 1 || $i2 == 1){
                            $nilai[1]['deskripsi'] = $nilai[1]['deskripsi'] . $d->aspek ;
                        } else{
                            $nilai[1]['deskripsi'] = $nilai[1]['deskripsi'] . ', ' . $d->aspek;
                        }
                        $nilai[1]['predikat'] =konversiNilai($d->score,"predikat")->penjelasan;
                        $i++;
                        $i2++;
                    }
                    elseif ($d->score <= 2 && $d->score > 1) {
                        if ($i == 1 || $i3 == 1){
                            $nilai[2]['deskripsi'] = $nilai[2]['deskripsi'] . $d->aspek;
                        } else{
                            $nilai[2]['deskripsi'] = $nilai[2]['deskripsi'] . ', ' . $d->aspek ;
                        }
                        $nilai[2]['predikat'] =konversiNilai($d->score,"predikat")->penjelasan;
                        $i++;
                        $i3++;
                    }else{
                        if ($i == 1 || $i4 == 1){
                            $nilai[3]['deskripsi'] = $nilai[3]['deskripsi'] . $d->aspek ;
                        } else{
                            $nilai[3]['deskripsi'] = $nilai[3]['deskripsi'] . ', ' . $d->aspek;
                        }
                        $nilai[3]['predikat'] =konversiNilai($d->score,"predikat")->penjelasan;
                        $i++;
                        $i4++;
                    }
                }
    
                $description = '';
                $awal = 0;
                // $nilai;
    
                for ($i=0; $i < count($nilai); $i++) { 
                
                    if ($nilai[$i]["predikat"]) {
                        if ($awal != 0) {
                            $description = $description. ', ';
                        }
                        $description = $description. $nilai[$i]["predikat"]. ' dalam ' .$nilai[$i]["deskripsi"] ;
                        $awal++;
                    }
                }
                return $description = $description . '.';
            
            case 2:

                $i1 = 1;
                $i2 = 1;
                $i3 = 1;
                $i4 = 1;
                $i = 1;
                $range = DB::table('converts')->get();
                foreach ($data as $d) {
                    if ($d["rataNilai"] >= $range[0]->nilai_bawah) {
                        if ($i == 1 || $i1 == 1){
                            $nilai[0]['deskripsi'] = $nilai[0]['deskripsi'] . $d["deskripsi"];
                        } else{
                            $nilai[0]['deskripsi'] = $nilai[0]['deskripsi'] . ', ' . $d["deskripsi"];
                        }
                        $nilai[0]['predikat'] = konversiNilai($d["rataNilai"],"nilai")? konversiNilai($d["rataNilai"],"nilai")->penjelasan : "Tidak Ada Predikat";
                        $i++;
                        $i1++;
                    }
                    elseif ($d["rataNilai"] >= $range[1]->nilai_bawah) {
                        // dd($nilai[0]['deskripsi']);
                        if ($i == 1 || $i2 == 1){
                            $nilai[1]['deskripsi'] = $nilai[1]['deskripsi'] . $d["deskripsi"] ;
                        } else{
                            $nilai[1]['deskripsi'] = $nilai[1]['deskripsi'] . ', ' . $d["deskripsi"];
                        }
                        $nilai[1]['predikat'] = konversiNilai($d["rataNilai"],"nilai")->penjelasan;
                        $i++;
                        $i2++;
                    }
                    elseif ($d["rataNilai"] >= $range[2]->nilai_bawah) {
                        if ($i == 1 || $i3 == 1){
                            $nilai[2]['deskripsi'] = $nilai[2]['deskripsi'] . $d["deskripsi"];
                        } else{
                            $nilai[2]['deskripsi'] = $nilai[2]['deskripsi'] . ', ' . $d["deskripsi"] ;
                        }
                        $nilai[2]['predikat'] = konversiNilai($d["rataNilai"],"nilai")->penjelasan;
                        $i++;
                        $i3++;
                    }else{
                        if ($i == 1 || $i4 == 1){
                            $nilai[3]['deskripsi'] = $nilai[3]['deskripsi'] . $d["deskripsi"] ;
                        } else{
                            $nilai[3]['deskripsi'] = $nilai[3]['deskripsi'] . ', ' . $d["deskripsi"];
                        }
                        $nilai[3]['predikat'] = konversiNilai($d["rataNilai"],"nilai")->penjelasan;
                        $i++;
                        $i4++;
                    }
                }
    
                $description = '';
                $awal = 0;
                // $nilai;
    
                for ($i=0; $i < count($nilai); $i++) { 
                
                    if ($nilai[$i]["predikat"]) {
                        if ($awal != 0) {
                            $description = $description. ', ';
                        }
                        $description = $description . $nilai[$i]["predikat"] . ' dalam ' . $nilai[$i]["deskripsi"] ;
                        $awal++;
                    }
                }
    
                return $description;
        }
    }
    else{
        return "Nilai Belum Diisi";
    }
    

    
}

function bulan($m){
    switch ($m) {
        case '01':
            return "Januari";

        case '02':
            return "Februari";

        case '03':
            return "Maret";

        case '04':
            return "April";

        case '05':
            return "Mei";

        case '06':
            return "Juni";

        case '07':
            return "Juli";

        case '08':
            return "Agustus";

        case '09':
            return "September";

        case '10':
            return "Oktober";

        case '11':
            return "November";

        case '12':
            return "Desember";

    }

    
}

function descCompetence($student,$levelsubject,$semester){
    $scores = DB::table('score_knowlegde_competences')
            ->join('knowledge_base_competences','score_knowlegde_competences.knowledge_base_competence_id','=','knowledge_base_competences.id')
            ->join('score_ratios','score_knowlegde_competences.score_ratio_id','=','score_ratios.id')
            ->where('knowledge_base_competences.level_subject_id',$levelsubject)
            ->where('score_knowlegde_competences.student_id',$student)
            ->get();

    $baseCompetences = DB::table('knowledge_base_competences')
            ->where('level_subject_id',$levelsubject)
            ->get();
    
    $kd = [];
    $i=0;
    foreach ($baseCompetences as $k) {
        $kd[$i] = [
            "id" => $k->id,
            "rataNilai" => 0,
            "deskripsi" =>''
        ];
        $i++;
    }

    $converts = DB::table('score_ratios')->get();
    
    $i = 0;
    foreach ($baseCompetences as $bc) {
        $j = 0;
        $tempNilai = 0;
        foreach ($converts as $convert){
            if (is_object(knowledgeScore($student,$convert->id,$bc->id))) {
                $tempNilai += knowledgeScore($student,$convert->id,$bc->id)->score;
                $j++;
            }
        }

        $kd[$i]["rataNilai"] = $j > 0 ? $tempNilai/$j : 0;
        $kd[$i]["deskripsi"] = $bc->pengetahuan_kompetensi_dasar;
        $i++;
    }
    
    return description($student, $semester, 2, $kd);
}

function descPractice($student,$levelsubject,$semester)
{
    $scores = DB::table('score_practice_competences')
                ->join('practice_base_competences','practice_base_competences.id','=','score_practice_competences.practice_base_competence_id')
                ->where('score_practice_competences.student_id',$student)
                ->where('practice_base_competences.level_subject_id',$levelsubject)
                ->get();

    $kd = [];
    $i=0;
    foreach ($scores as $score) {
        $banyakData = 0;

        $banyakData += $score->praktek ? 1 : 0;
        $banyakData += $score->produk ? 1 : 0;
        $banyakData += $score->proyek? 1 : 0;

        $kd[$i] = [
            "id" => $score->id,
            "rataNilai" => $banyakData > 0 ? ($score->praktek+$score->produk+$score->proyek)/$banyakData :  ($score->praktek+$score->produk+$score->proyek),
            "deskripsi" => $score->keterampilan_kompetensi_dasar
        ];


        $i++;
    }

    return description($student, $semester, 2, $kd);

}

function getUser($id){
    return User::find($id);
}

function entryPayment($id){
    return $entryPayment = EntryPayment::where('student_id', $id)->first();
}

function creditPayment($id){
    $jumlahBayar = 0;
    $creditPayments = CreditPayment::where('student_id', $id)->get();

    foreach ($creditPayments as $creditPayment) {
        $jumlahBayar += $creditPayment->jumlah_bayar;
    }
    return $jumlahBayar;
}

function monthlyPayment($id){
    return $monthlyPayment = MonthlyPayment::where('student_id', $id)->first();
}

function creditMonthlyPayment($id, $year){
    return $creditMonthlyPayment = CreditMonthlyPayment::where('student_id', $id)
                                                         ->where('year_id', $year)->get();
}

function bulanBayar($bulan)
{
    switch ($bulan) {
        case 1:
            return "Juli";

        case 2:
            return "Agustus";

        case 3:
            return "September";

        case 4:
            return "Oktober";

        case 5:
            return "November";

        case 6:
            return "Desember";

        case 7:
            return "Januari";

        case 8:
            return "Februari";

        case 9:
            return "Maret";

        case 10:
            return "April";

        case 11:
            return "Mei";

        case 12:
            return "Juni";
    }
}

function levelStudent($id)
{
    return $levelStudent = LevelStudent::where('student_id', $id)->get();
}

function avScorePerCompentence($student, $kd){
    $score = DB::table('score_knowlegde_competences')
                        ->where('student_id', $student)
                        ->where('knowledge_base_competence_id', $kd)
                        ->where('score','>', 0)
                        ->avg('score');

    return $score ? $score : 0;
}