<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BookPayment;
use App\Student;
use App\Year;
use App\Helpers\YearHelper;

class BookPaymentController extends Controller
{
    public function index(){
        $students = Student::all();
        return view('payments.book',compact('students'));
    }

    public function store(Request $request, Student $student, Year $year){
        if (!$request->total) {
            $request->total = 0;
        }
        $entryPayment = BookPayment::updateOrCreate(
            ['student_id' => $student->id, 'year_id' => $year->id],            
            ['jumlah' => $request->total, ]
        );

        return redirect('/buku')->with('status','Harga Buku Siswa Berhasil Diatur');
    }
}
