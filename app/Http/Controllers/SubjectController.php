<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required',
            'kategori' => 'required',            
        ]);

        Subject::create($request->all());
        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Subject $student
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        Subject::where('id',$subject->id)
                ->update([
                    'mata_pelajaran' => $request->mata_pelajaran,
                    'kategori' => $request->kategori
                ]);
        
        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Diubah');
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        Subject::destroy($subject->id);
        return redirect('/subjects')->with('status','Mata Pelajaran Berhasil Dihapus');
    }
}
