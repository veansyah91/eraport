<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BookPayment;
use App\CreditBookPayment;

class CreditBookPaymentController extends Controller
{
    public function index(BookPayment $bookpayment){
        $creditBookPayments = CreditBookPayment::where('book_payment_id', $bookpayment->id)->get();
        return view('payments.credit-book',compact('bookpayment','creditBookPayments'));
    }

    public function store(Request $request, BookPayment $bookpayment){
        $bookPayment = CreditBookPayment::create([
            'book_payment_id' => $bookpayment->id,
            'tanggal_bayar' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/buku/detail/' . $bookpayment->id)->with('status','Pembayaran Buku Berhasil');
    }

    public function destroy(CreditBookPayment $creditbookpayment){
        CreditBookPayment::destroy($creditbookpayment->id);
        return redirect('/buku/detail/' . $creditbookpayment->book_payment_id)->with('status','Pembayaran Buku Berhasil Dihapus');
    }
}
