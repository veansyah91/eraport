<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MonthlyPayment;
use App\Student;
use App\Year;

class MonthlyPaymentController extends Controller
{
    public function index(){
        $students = Student::all();
        $year = Year::orderByDesc('id')->first();
        return view('payments.monthly',compact('students','year'));
    }

    public function store(Request $request, Student $student){
        if (!$request->total) {
            $request->total = 0;
        }
        $monthlyPayment = MonthlyPayment::updateOrCreate(
            ['student_id' => $student->id,],
            ['jumlah' => $request->total, ]
        );

        return redirect('/spp')->with('status','SPP Siswa Berhasil Diatur');
    }
}
