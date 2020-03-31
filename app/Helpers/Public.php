<?php

use Illuminate\Support\Facades\DB;
use App\StaffPeriod;
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

function checkyear(){
    $years = DB::table('years')->get();
    $year = last($years);

    if ($year) {
        $semesters = DB::table('semesters')
                        ->where('year_id','=',$year[0]->id)
                        ->get();
        $semester = last(last($semesters));
    }
    
    $after = year()+1;
    if (!$year||$year[0]->awal <> year()){
        return '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
        Tahun Ajaran <strong>'.year().'/'.$after.'</strong> dan Semester <strong>'.semester().'</strong> Belum Diatur <span><a href="/tambah-tahun-ajar" class="btn btn-danger btn-sm">Atur Sekarang</a></span>
        </div>';
    } elseif (!$semester||$semester->semester <> semester()) {
        return '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
        Semester <strong>'.semester().'</strong> Tahun Ajaran <strong>'.year().'/'.$after.'</strong> Belum Diatur <span><a href="/tambah-tahun-ajar-genap" class="btn btn-danger btn-sm">Atur Sekarang</a></span>
        </div>';
    };

    return null;
}

function staffPeriods($position){
    
}