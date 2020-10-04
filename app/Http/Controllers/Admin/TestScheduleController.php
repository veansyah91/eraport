<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\YearHelper;

use App\CreditMonthlyPayment;
use App\Semester;
use App\Level;
use App\MonthlyPayment;
use App\StudentTestSchedule;
use App\Student;
use App\ThemeTestSchedule;
use App\SubjectTestSchedule;
use App\TestSchedule;
use App\LevelSubject;
use App\LevelStudent;

class TestScheduleController extends Controller
{
    public function index(){
        $testschedules = TestSchedule::orderBy('id', 'desc')->get();
        // dd($testschedules);
        return view('test-schedule.index', compact('testschedules'));
    }

    public function setSchedule(Request $request, Semester $semester){
        $testSchedule = TestSchedule::updateOrCreate(
                    ['semester_id' => $semester->id, 
                    'kategori' => $request->kategori],
                    ['mulai' => $request->mulai,
                    'selesai' => $request->selesai]
        );

        return redirect('/test-schedule')->with('status','Jadwal Ujian Berhasil Diatur');
    }

    public function testSchedulePerLevel(Level $level){
        $sublevel = DB::table('sub_levels')->where('level_id', $level->id)->get();    
        
        $temaTestSchedules = DB::table('theme_test_schedules')
                                ->where('level_id', $level->id)
                                ->where('semester_id', YearHelper::thisSemester()->id)
                                ->select('tema')
                                ->distinct()
                                ->get();

                                // dd($temaTestSchedules );

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('level_students.year_id',YearHelper::thisSemester()->year_id)
                                ->where('level_students.level_id',$level->id)
                                ->select('sub_level_students.id','sub_level_students.level_student_id','students.nama','sub_level_students.sub_level_id','level_students.student_id')
                                ->get();

        $levelsubjects = DB::table('level_subjects')
                                ->join('levels', 'level_subjects.level_id','=','levels.id')
                                ->join('subjects','level_subjects.subject_id','=','subjects.id')
                                ->where('levels.id',$level->id)
                                ->where('level_subjects.semester_id',YearHelper::thisSemester()->id)
                                ->select('level_subjects.id','level_subjects.kkm','level_subjects.subject_id','levels.kelas','subjects.mata_pelajaran','subjects.kategori','subjects.sub_of','subjects.tema')
                                ->get();  
        // Atur Izin Ujian Siswa
        $testSchedulesForMid = TestSchedule::where('semester_id', YearHelper::thisSemester()->id)
                                            ->where('kategori', 'Tengah Semester')->first();

        $testSchedulesForLast = TestSchedule::where('semester_id', YearHelper::thisSemester()->id)
                                            ->where('kategori', 'Akhir Semester')->first();

        // Atur Izin Ujian Tengah Semester
        if ($testSchedulesForMid) {
            foreach ($sublevelstudents as $student) {
                $monthlyPayment = MonthlyPayment::where('student_id', $student->student_id)->first();
                $creditMonthly = CreditMonthlyPayment::where('student_id', $student->student_id)
                                                ->where('year_id', YearHelper::thisSemester()->year_id)->count();
                if ($creditMonthly > 6) {
                    $creditMonthly -= 6;
                }

                if ($monthlyPayment) {
                    if ($creditMonthly > 2 || $monthlyPayment->jumlah == 0) {
                        // Cek apakah jadwal ujian siswa sudah diinput atau belum
                        $studentSchedules = StudentTestSchedule::where('level_student_id', $student->level_student_id)
                                                                ->where('test_schedule_id', $testSchedulesForMid->id)
                                                                ->count();
                        // dd($studentSchedules);
                        if ($studentSchedules == 0) {
                            $inputStudentSchedule = new StudentTestSchedule;
                            $inputStudentSchedule->level_student_id = $student->level_student_id;
                            $inputStudentSchedule->test_schedule_id = $testSchedulesForMid->id;
                            $inputStudentSchedule->allow = 'on';
                            $inputStudentSchedule->save();
                        }
                    }
                }
                
                
            }
        }

        // atur ijin ujian Akhir semester
        if ($testSchedulesForLast) {
            foreach ($sublevelstudents as $student) {
                $monthlyPayment = MonthlyPayment::where('student_id', $student->student_id)->first();
                $creditMonthly = CreditMonthlyPayment::where('student_id', $student->student_id)
                                                ->where('year_id', YearHelper::thisSemester()->year_id)->count();
                if ($creditMonthly > 6) {
                    $creditMonthly -= 6;
                }

                if ($monthlyPayment) {
                    if ($creditMonthly > 5 || $monthlyPayment->jumlah == 0) {
                        // Cek apakah jadwal ujian siswa sudah diinput atau belum
                        $studentSchedules = StudentTestSchedule::where('level_student_id', $student->level_student_id)
                                                                ->where('test_schedule_id', $testSchedulesForLast->id)
                                                                ->count();
                        // dd($studentSchedules);
                        if ($studentSchedules == 0) {
                            $inputStudentSchedule = new StudentTestSchedule;
                            $inputStudentSchedule->level_student_id = $student->level_student_id;
                            $inputStudentSchedule->test_schedule_id = $testSchedulesForLast->id;
                            $inputStudentSchedule->allow = 'on';
                            $inputStudentSchedule->save();
                        }
                    }
                }
                
                
            }
        }
        // dd($testSchedulesForLast);
        return view('test-schedule.level', compact('sublevel','sublevelstudents','level','levelsubjects','testSchedulesForMid','testSchedulesForLast','temaTestSchedules'));
    }

    public function setTestSchedulePerLevel(Request $request, LevelSubject $levelsubject){
        $testSchedule = SubjectTestSchedule::updateOrCreate(
                    ['level_subject_id' => $levelsubject->id, 
                    'kategori' => $request->kategori],
                    ['tanggal' => $request->tanggal]
        );

        return redirect('/test-schedule/'.$levelsubject->level_id)->with('status','Jadwal Ujian Berhasil Diatur');
    }

    public function setTestSchedulePerStudent(Request $request, TestSchedule $schedule, LevelStudent $levelstudent){
        $allow = 'off';
        if ($request->allow) {
            $allow = $request->allow;
        }

        $studentTestSchedule = StudentTestSchedule::updateOrCreate(
                                            ['level_student_id' => $levelstudent->id, 
                                            'test_schedule_id' => $schedule->id],
                                            ['allow' => $allow]
                                );

        return redirect('/test-schedule/'.$levelstudent->level_id)->with('status','Perijinan Ujian Siswa Berhasil Diubah');                
    }

    public function setTestSchedulePerTema(Request $request, Semester $semester, Level $level)
    {
        // dd($request);
        // MID
        if ($request->midsemestercheckbox == 1) {
            if ($request->tanggaltemamid) {
                // cek ada atau tidak data 
                $testSchedule = ThemeTestSchedule::where('tema', $request->tema)
                                                ->where('semester_id', $semester->id)
                                                ->where('level_id', $level->id)
                                                ->where('kategori', 'Tengah Semester')
                                                ->first();

                if ($testSchedule) {
                    $testScheduleUpdate = ThemeTestSchedule::where('id', $testSchedule->id)->update([
                        'tanggal' => $request->tanggaltemamid
                    ]);
                    
                } else {
                    $testScheduleCreate = new ThemeTestSchedule;
                    $testScheduleCreate->tema = $request->tema;
                    $testScheduleCreate->semester_id = $semester->id;
                    $testScheduleCreate->level_id = $level->id;
                    $testScheduleCreate->kategori = 'Tengah Semester';
                    $testScheduleCreate->tanggal= $request->tanggaltemamid;
                    $testScheduleCreate->save();
                }
            }            
        }

        // MID
        if ($request->lastsemestercheckbox == 1) {
            if ($request->tanggaltemalast) {
                // cek ada atau tidak data 
                $testSchedule = ThemeTestSchedule::where('tema', $request->tema)
                                                    ->where('semester_id', $semester->id)
                                                    ->where('kategori', 'Akhir Semester')
                                                    ->first();

                if ($testSchedule) {
                    $testScheduleUpdate = ThemeTestSchedule::where('id', $testSchedule->id)->update([
                        'tanggal' => $request->tanggaltemalast
                    ]);
                } else {
                    $testScheduleCreate = new ThemeTestSchedule;
                    $testScheduleCreate->tema = $request->tema;
                    $testScheduleCreate->semester_id = $semester->id;
                    $testScheduleCreate->kategori = 'Akhir Semester';
                    $testScheduleCreate->level_id = $level->id;
                    $testScheduleCreate->tanggal= $request->tanggaltemalast;
                    $testScheduleCreate->save();
                }
            }           
        }

        return redirect('/test-schedule/'.$level->id)->with('status','Jadwal Ujian Berhasil Diatur');
    }

    public function updateTestSchedulePerTema(Request $request, Semester $semester, Level $level){
        // dd($request);
        $testSchedule = ThemeTestSchedule::updateOrCreate(
                            ['semester_id' => $semester->id, 
                            'level_id' => $level->id,
                            'tema' => $request->temainput,
                            'kategori' => $request->kategoritema],
                            ['tanggal' => $request->tanggaltema]
                        );
        return redirect('/test-schedule/'.$level->id)->with('status','Perijinan Ujian Siswa Berhasil Diubah'); 
    }
}
