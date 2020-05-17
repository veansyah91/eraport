<?php

namespace App\Http\Controllers;

use App\Convert;
use App\Score;
use Illuminate\Http\Request;

class ConvertController extends Controller
{

    public function index()
    {
        $converts = Convert::all();
        $scores = Score::all();
        return view('converts.index',compact('converts','scores'));
    }

    public function store(Request $request)
    {
        $total = 4;

        for ($i=0; $i < $total; $i++) { 
            $convert = new Convert;
            $convert->nilai_atas = $request->nb[$i];
            $convert->nilai_bawah = $request->nk[$i];
            $convert->predikat = $request->predikat[$i];
            $convert->penjelasan = $request->penjelasan[$i];
            $convert->nilai_huruf = $request->nilaihuruf[$i];
            $convert->save();
        }

        return redirect('/converts')->with('status','Konversi Nilai Berhasil Diatur');
    }

    public function update(Request $request, Convert $convert)
    {
        $total = 4;

        for ($i=0; $i < $total; $i++) { 
            Convert::where('id',$request->id[$i])
                    ->update([
                        'nilai_atas' => $request->nb[$i],
                        'nilai_bawah' => $request->nk[$i],
                        'predikat' => $request->predikat[$i],
                        'predikat' => $request->predikat[$i],
                        'nilai_huruf' => $request->nilaihuruf[$i],
                    ]);
        }

        return redirect('/converts')->with('status','Konversi Nilai Berhasil Diubah');
    }

    public function storescore()
    {
        $periods=['Harian','Tengah Semester','Akhir Semester'];
        $percents=[40,30,30];

        for ($i=0; $i < count($periods); $i++) { 
            $score = new Score;
            $score->period = $periods[$i];
            $score->percent = $percents[$i];
            $score->save();
        }    

        return redirect('/converts')->with('status','Persentase Nilai Berhasil Diatur');
    }

    public function updatescore(Request $request)
    {

        for ($i=0; $i < count($request->percent) ; $i++) { 
            Score::where('id',$request->id[$i])
                        ->update([
                            'percent' => $request->percent[$i],
                        ]);
        }

        return redirect('/converts')->with('status','Persentase Nilai Berhasil Diubah');
    }

}
