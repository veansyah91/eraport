<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\EntryPayment;
use App\CreditPayment;
use App\CreditMonthlyPayment;
use App\MonthlyPayment;
use App\Year;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function psb(){
        $entryPayment = EntryPayment::where('student_id', Auth::user()->student->id)->first();
        $creditPayments = CreditPayment::where('student_id', Auth::user()->student->id)->get();
        return view('users.student.psb',compact('entryPayment','creditPayments'));
    }

    public function spp(Year $year){
        $monthlyPayment = MonthlyPayment::where('student_id', Auth::user()->student->id)->first();
        $creditMonthlys = CreditMonthlyPayment::where('student_id',Auth::user()->student->id)
                                                ->where('year_id', $year->id)->get();
        return view('users.student.spp',compact('monthlyPayment','creditMonthlys','year'));
    }
}
