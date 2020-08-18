<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\BookPayment;
use App\CreditBookPayment;

class BookPaymentHelper
{
    public static function getPayment($student, $year){
        return $bookPayment = BookPayment::where('student_id', $student)
                                         ->where('year_id', $year)
                                         ->first();
    }

    public static function paymentAmount($id){
        $creditPayment = CreditBookPayment::where('book_payment_id', $id)->get();

        if ($creditPayment){
            return $creditPayment->sum('jumlah');
        }
        else{
            return 0;
        }
    }
}