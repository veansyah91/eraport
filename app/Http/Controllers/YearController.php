<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Year;
use App\Semester;

class YearController extends Controller
{
    public function ganjil()
    {
        $year = new Year;
        $year->awal = year();
        $year->akhir = year()+1;
        $year->save();

        $years = DB::table('years')->get();
        $year = last($years);

        $semester = new Semester;
        $semester->year_id = $year[0]->id;
        $semester->semester = "GANJIL";
        $semester->save();

        return redirect('/');
    }

    public function genap()
    {
        $years = Year::all();
        $year = last($years);

        $semester = new Semester;
        $semester->year_id = $year[0]->id;
        $semester->semester = "GENAP";
        $semester->save();

        return redirect('/');
    }
}
