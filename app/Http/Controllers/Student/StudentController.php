<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\BookPayment;
use App\EntryPayment;
use App\CreditPayment;
use App\CreditBookPayment;
use App\CreditMonthlyPayment;
use App\LevelStudent;
use App\LevelSubject;
use App\MonthlyPayment;
use App\SubjectTestSchedule;
use App\TestSchedule;
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

    public function buku(Year $year){
        $bookPayment = BookPayment::where('student_id', Auth::user()->student->id)
                                    ->where('year_id', $year->id)->first();
        $creditBookPayments = CreditBookPayment::where('book_payment_id', $bookPayment->id)->get();
        return view('users.student.bayar-buku',compact('bookPayment','creditBookPayments','year'));
    }

    public function test(TestSchedule $testschedule){
        $levelStudentNow = LevelStudent::where('year_id', $testschedule->semester->year_id)
                            ->where('student_id', Auth::user()->student->id)
                            ->first();

        $levelSubjects = LevelSubject::where('level_id',$levelStudentNow->level_id)
                            ->where('semester_id', $testschedule->semester_id)
                            ->get();

        $subjectTestsNow = SubjectTestSchedule::where('tanggal', Date('Y-m-d'))
                            ->get();

                            
        $subjectTestSchedules = DB::table('subject_test_schedules')
                            ->join('level_subjects', 'level_subjects.id', '=', 'subject_test_schedules.level_subject_id')
                            ->join('subjects','subjects.id','=','level_subjects.subject_id')
                            ->where('level_subjects.level_id', $levelStudentNow->level_id)
                            ->where('level_subjects.semester_id', $testschedule->semester_id)
                            ->orderBy('subject_test_schedules.tanggal', 'asc')
                            ->get();
                            // dd($levelStudentNow);



        return view('users.student.test', compact('testschedule','subjectTestsNow','levelSubjects','subjectTestSchedules','levelStudentNow'));
    }
}
