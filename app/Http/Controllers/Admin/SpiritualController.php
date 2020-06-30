<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Spiritual;
use Illuminate\Http\Request;

class SpiritualController extends Controller
{

    public function index()
    {
        $spirituals = Spiritual::all();
        return view('spirituals.index',compact('spirituals'));
    }

    public function store(Request $request)
    {
        if(!$request->aspek_spiritual){
            return redirect('/spirituals')->with('failed','Data Penilaian Spiritual Gagal Ditambahkan');
        }

        $spiritual = new Spiritual;
        $spiritual->aspek = $request->aspek_spiritual;
        $spiritual->save();

        return redirect('/spirituals')->with('status','Data Penilaian Spiritual Berhasil Ditambahkan');

    }

    public function update(Request $request, Spiritual $spiritual)
    {
        if(!$request->aspek_spiritual){
            return redirect('/spirituals')->with('failed','Data Penilaian Spiritual Gagal Diubah');
        }
        Spiritual::where('id',$spiritual->id)
                    ->update([
                        'aspek' => $request->aspek_spiritual
                    ]);

        return redirect('/spirituals')->with('status','Data Penilaian Spiritual Berhasil Diubah');
    }

    public function destroy(Spiritual $spiritual)
    {
        Spiritual::destroy($spiritual->id);
        return redirect('/spirituals')->with('status','Data Penilaian Spiritual Berhasil Diuhapus');
    }
}
