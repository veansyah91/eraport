<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Social;

class SocialController extends Controller
{

    public function index()
    {
        $socials = Social::all();
        return view('socials.index',compact('socials'));
    }

    public function store(Request $request)
    {
        if(!$request->aspek_social){
            return redirect('/socials')->with('failed','Data Penilaian Sosial Gagal Ditambahkan');
        }

        $social = new Social;
        $social->aspek = $request->aspek_social;
        $social->save();

        return redirect('/socials')->with('status','Data Penilaian Sosial Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if(!$request->aspek_social){
            return redirect('/socials')->with('failed','Data Penilaian Sosial Gagal Diubah');
        };

        Social::where('id',$id)
                    ->update([
                        'aspek' => $request->aspek_social
                    ]);

        return redirect('/socials')->with('status','Data Penilaian Sosial Berhasil Diubah');
    }

    public function destroy($id)
    {
        Social::destroy($id);
        return redirect('/socials')->with('status','Data Penilaian Sosial Berhasil Dihapus');
    }
}
