<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $extracurriculars = Extracurricular::all();
        return view('extracurriculars.index',compact('extracurriculars'));
    }

    public function store(Request $request)
    {
        if(!$request->nama){
            return redirect('/extracurriculars')->with('failed','Ekstrakurikuler Gagal Ditambahkan');
        }
        $extracurricular = new Extracurricular;
        $extracurricular->nama = $request->nama;
        $extracurricular->save();

        return redirect('/extracurriculars')->with('status','Ekstrakurikuler Berhasil Ditambahkan');
    }

    public function show(Extracurricular $extracurricular)
    {
        //
    }

    public function edit(Extracurricular $extracurricular)
    {
        //
    }

    public function update(Request $request, Extracurricular $extracurricular)
    {
        if(!$request->nama){
            return redirect('/extracurriculars')->with('failed','Ekstrakurikuler Gagal Ditambahkan');
        }

        Extracurricular::where('id',$extracurricular->id)
                    ->update([
                        'nama' => $request->nama
                    ]);

        return redirect('/extracurriculars')->with('status','Ekstrakurikuler Berhasil Diubah');
    }

    public function destroy(Extracurricular $extracurricular)
    {
        Extracurricular::destroy($extracurricular->id);
        return redirect('/extracurriculars')->with('status','Ekstrakurikuler Berhasil Dihapus');
    }
}
