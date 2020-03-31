<?php

namespace App\Http\Controllers;

use App\Position;
use App\StaffPeriod;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
        $staffperiod = DB::table('staff_periods')
                        ->where('semester_id','=',$semester->id)
                        ->get();
        $allstaffperiod = StaffPeriod::all();

        return view('positions.index',compact('positions','staffperiod','semester','allstaffperiod'));
    }

    public function default()
    {
        $request[0] = "KEPALA SEKOLAH";
        $request[1] = "WAKIL KEPALA SEKOLAH";
        $request[2] = "BENDAHARA";
        $request[3] = "TATA USAHA";
        $request[4] = "GURU";

        for ($i=0; $i < 5; $i++) { 
            $position = new Position;
            $position->jabatan = $request[$i];
            $position->save();
        }

        return redirect('/positions')->with('status','Data Jabatan Berhasil Ditambahkan');
    }

    public function defaultbefore(){
        $previoussemester = Semester::all(); 
        $totalData = count($previoussemester);
        $nowsemester = $previoussemester[$totalData-1];
        $copyData = $previoussemester[$totalData-2];
        $temp = DB::table('staff_periods')
                    ->where('semester_id','=',$copyData->id)
                    ->get();

        for ($i=0; $i < count($temp); $i++) { 
            $staffPeriods = new StaffPeriod;
            $staffPeriods->semester_id = $nowsemester->id;
            $staffPeriods->position_id = $temp[$i]->position_id;
            $staffPeriods->staff_id = $temp[$i]->staff_id;
            $staffPeriods->save();
        }
        
        return redirect('/positions')->with('status','Data Jabatan Berhasil Diatur');
    }

    public function store(Request $request)
    {
        $position = new Position;
        $position->jabatan = $request->jabatan;
        $position->save();

        return redirect('/positions')->with('status','Data Jabatan Berhasil Ditambahkan');
    }

    public function staffstore(Request $request){
        if (is_array($request->staffselect)){
            for ($i=0; $i < count($request->staffselect); $i++) {
                $staffData = DB::table('staff_periods')
                                ->where('semester_id','=',$request->semester)
                                ->where('position_id','=',$request->position)
                                ->where('staff_id','=',$request->staffselect[$i])
                                ->get();
                if (count($staffData)<1) {
                    $staffPeriods = new StaffPeriod;
                    $staffPeriods->semester_id = $request->semester;
                    $staffPeriods->position_id = $request->position;
                    $staffPeriods->staff_id = $request->staffselect[$i];
                    $staffPeriods->save();
                }
            };
            return redirect('/positions')->with('status','Data Staff Berhasil Ditambahkan');

        }else{
            $staffPeriods = new StaffPeriod;
            $staffPeriods->semester_id = $request->semester;
            $staffPeriods->position_id = $request->position;
            $staffPeriods->staff_id = $request->staffselect;
            $staffPeriods->save();
        }       

        return redirect('/positions')->with('status','Data Jabatan Berhasil Ditambahkan');
    }

    public function destroy(Position $position)
    {
        DB::table('staff_periods')->where('position_id', '=', $position->id)->delete();
        Position::destroy($position->id);
        return redirect('/positions')->with('status','Data Jabatan Berhasil Dihapus');
    }

    public function destroystaff(StaffPeriod $staffperiod)
    {
        StaffPeriod::destroy($staffperiod->id);
        return redirect('/positions')->with('status','Data Staff Berhasil Dihapus');
    }
}
