<?php

use Illuminate\Support\Facades\DB;
use App\StaffPeriod;
use App\Year;
use App\Semester;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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

function semester(){
    $bulan_ajar = date('m');
    if ($bulan_ajar < 7)
    {
        return $semester = "GENAP";
    }else{
        return $semester = "GANJIL";
    }
}

function kelas(){
    $kelas = DB::table('levels')->get();
    return $kelas;
}

function subkelas($idlevel){
    $subkelas = DB::table('sub_levels')->where('level_id', $idlevel)->get();
    return $subkelas;
}

function subKelasSiswa($id){
    $subkelassiswa = DB::table('sub_level_students')
                        ->join('sub_levels','sub_levels.id','=','sub_level_students.sub_level_id')
                        ->where('level_student_id',$id)
                        ->select('sub_level_students.*','sub_levels.alias')
                        ->first();

    return $subkelassiswa;

    
}

function checkyear(){
    

    $years = Year::aLL();
    $year = last($years);

    if ($year) {
        $semesters = DB::table('semesters')
                        ->where('year_id','=',$year[0]->id)
                        ->get();
        $semester = last(last($semesters));
    }
    
    $after = year()+1;
    if (!$year||$year[0]->awal <> year()){
        $year = new Year;
        $year->awal = year();
        $year->akhir = year()+1;
        $year->save();

        $years = DB::table('years')->get();
        $year = last($years);

        $semester = new Semester;
        $semester->year_id = $year[0]->id;
        $semester->semester = "GANJIL";
        $semester->save();

    } elseif (!$semester||$semester->semester <> semester()) {
        $years = Year::all();
        $year = last($years);

        $semester = new Semester;
        $semester->year_id = $year[0]->id;
        $semester->semester = "GENAP";
        $semester->save();
    };

}

function teacher($id){
    $staff_teacher = DB::table('staff')
                        ->where('id',$id)
                        ->first();

    return $staff_teacher->nama;
}

function levelsubjectteacher($levelsucject,$sublevel){
    return $levelsubjectteacher = DB::table('level_subject_teachers')
                                ->join('staff','staff.id','=','level_subject_teachers.staff_id')
                                ->where('level_subject_teachers.level_subject_id',$levelsucject)
                                ->where('level_subject_teachers.sub_level_id',$sublevel)
                                ->select('level_subject_teachers.id','level_subject_teachers.staff_id','staff.nama')
                                ->get();
    // $nama_staff = $levelsubjectteacher;
    // return $nama_staff;
}
