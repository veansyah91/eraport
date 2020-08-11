<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\EntryPayment;
use App\Student;
use Illuminate\Http\Request;

class EntryPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('payments.index',compact('students'));
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
    public function store(Request $request, Student $student)
    {   
        if (!$request->total) {
            $request->total = 0;
        }
        $entryPayment = EntryPayment::updateOrCreate(
            ['student_id' => $student->id,],
            ['total' => $request->total, ]
        );

        return redirect('/psb')->with('status','PSB Siswa Berhasil Diatur');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntryPayment  $entryPayment
     * @return \Illuminate\Http\Response
     */
    public function show(EntryPayment $entryPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntryPayment  $entryPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(EntryPayment $entryPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntryPayment  $entryPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntryPayment $entryPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntryPayment  $entryPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryPayment $entryPayment)
    {
        //
    }
}
