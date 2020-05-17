<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\School;
use App\Year;

class SchoolController extends Controller
{

    public function __construct(){
        checkyear();
    }
    
    public function index()
    {
        $school = School::all();
        $years = Year::all();
        $reverse_years = $years->reverse();
        return view('schools.index', compact('school', 'reverse_years'));
    }

    public function create()
    {
        return view('schools.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'nss' => 'required|unique:schools',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'website' => 'required',
            'email' => 'required|email:rfc',
            'npsn' => 'required|unique:schools'
        ]);

        School::create($request->all());
        return redirect('/')->with('status','Data Sekolah Berhasil Ditambahkan');
    }

    public function edit()
    {
        $school = School::all();
        return view('schools.ubah', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'nss' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'website' => 'required',
            'email' => 'required|email:rfc',
            'status' => 'required',
            'npsn' => 'required'
        ]);

        School::where('id', $school->id)
            ->update([
                'nama_sekolah' => $request->nama_sekolah,
                'nss' => $request->nss,
                'alamat' => $request->alamat,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'website' => $request->website,
                'email' => $request->email,
                'status' => $request->status,
                'npsn' => $request->npsn
            ]);

        return redirect('/')->with('status','Data Staff Berhasil Diubah');
    }
}
