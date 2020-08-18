<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Semester;
use App\Year;

class YearHelper {

    public static function year(){
        $bulan_ajar = date('m');
        if ($bulan_ajar < 7)
        {
            return $tahun_ajar = date('Y')-1;
        }else{
            return $tahun_ajar = date('Y');
        }
    }

    public static function semester(){
        $bulan_ajar = date('m');
        if ($bulan_ajar < 7)
        {
            return $semester = "GENAP";
        }else{
            return $semester = "GANJIL";
        }
    }

    public static function thisSemester(){
        return $year = Semester::get()->last();
    }

    public static function checkThisYear(){
        $year = Year::get()->last();

        if ($year) {
            $semester = Semester::where('year_id','=',$year->id)->get()->last();
        }

        $after = YearHelper::year() + 1;

        if (!$year||$year->awal <> YearHelper::year()){
            DB::table('years')->insertOrIgnore([
                ['awal' => YearHelper::year(), 'akhir' => YearHelper::year()+1,'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
            ]);
    
            $year = Year::get()->last();
    
            DB::table('semesters')->insertOrIgnore([
                ['year_id' => $year->id, 'semester' => "GANJIL",'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
            ]);
    
        } elseif (!$semester||$semester->semester <> YearHelper::semester()) {
            $year = Year::get()->last();
    
            $semester = new Semester;
            $semester->year_id = $year->id;
            $semester->semester = "GENAP";
            $semester->save();
        };
    }
}
