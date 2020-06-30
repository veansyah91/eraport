<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{

    public function __construct(){
        checkyear();
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index',compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required',
            'kategori' => 'required',            
        ]);

        $subject = new Subject;
        $subject->mata_pelajaran = $request->mata_pelajaran;
        $subject->kategori = $request->kategori;
        $subject->sub_of = $request->sub;
        $subject->save();

        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Ditambahkan');
    }

    public function update(Request $request, Subject $subject)
    {
        Subject::where('id',$subject->id)
                ->update([
                    'mata_pelajaran' => $request->mata_pelajaran,
                    'kategori' => $request->kategori,
                    'sub_of' => $request->sub
                ]);
        
        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Diubah');
        // dd($request);
    }

    public function destroy(Subject $subject)
    {
        Subject::destroy($subject->id);
        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Dihapus');
    }
}
