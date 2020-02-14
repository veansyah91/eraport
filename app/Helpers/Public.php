<?php

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function year()
{
    $years = DB::table('years')->get();
    $year = last($years);
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
        $semester = "GENAP";
    }else{
        $semester = "GANJIL";
    }
    
    return $semester;
}

function tokenAPI(){
    $client = new Client();
    $request = $client->get('https://x.rajaapi.com/poe');
    $response = $request->getBody();
    $uniquecode = json_decode($response)->token;
    return $uniquecode;
}

function provinsi(){
    $client = new Client();
    $request = $client->get('https://x.rajaapi.com/MeP7c5ne'.tokenAPI().'/m/wilayah/provinsi');
    $response = $request->getBody();
    $uniquecode = json_decode($response)->data;
    return $uniquecode;
}

function kelas(){
    $kelas = DB::table('levels')->get();
    return $kelas;
}

function subkelas($idlevel){
    $subkelas = DB::table('sub_levels')->where('level_id', $idlevel)->get();
    return $subkelas;
}