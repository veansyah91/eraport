<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MonthlyPayment;
use App\CreditMonthlyPayment;
use App\Student;
use App\Year;

class CreditMonthlyPaymentController extends Controller
{
    public function index(Year $year, Student $student){

        $monthlyPayment = MonthlyPayment::where('student_id', $student->id)->first(); 
        $creditMonthlys = CreditMonthlyPayment::where('student_id',$student->id)
                                                ->where('year_id', $year->id)->get();
        
        return view('payments.credit-monthly',compact('monthlyPayment','creditMonthlys','year'));
    }

    public function store(Request $request, Year $year, Student $student){
        for ($i=0; $i < $request->bulan; $i++) { 
            $creditMonthly = CreditMonthlyPayment::create([
                'student_id' => $student->id,
                'year_id' => $year->id,
                'jumlah_bayar' => $request->jumlah,
                'tanggal_bayar' => $request->tanggal
            ]);
        }

        return redirect('/spp')->with('status','SPP Siswa Berhasil Dibayar');
    }
}
