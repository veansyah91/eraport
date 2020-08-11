<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\EntryPayment;
use App\CreditPayment;
use Illuminate\Http\Request;

class CreditPaymentController extends Controller
{
    public function index(Student $student){
        $entryPayment = EntryPayment::where('student_id',$student->id)->first();
        $creditPayments = CreditPayment::where('student_id',$student->id)->get();
        $jumlahbayar = 0;
        foreach ($creditPayments as $creditPayment) {
            $jumlahbayar += $creditPayment->jumlah_bayar;
        }
        return view('payments.credit',compact('entryPayment','jumlahbayar','creditPayments'));
    }

    public function store(Request $request, Student $student){
        $creditPayment = CreditPayment::create([
            'student_id' => $student->id,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal_bayar' => $request->tanggal_bayar
        ]);

        return redirect('/credit-payment/' . $student->id)->with('status','PSB Siswa Berhasil Dibayar');
    }

    public function destroy(CreditPayment $creditPayment){
        CreditPayment::destroy($creditPayment->id);
        return redirect('/credit-payment/' . $creditPayment->student_id)->with('status','PSB Siswa Berhasil Dibayar');
    }
}
