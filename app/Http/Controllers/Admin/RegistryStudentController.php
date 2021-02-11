<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\StudentRegistrySchedule;
use App\Http\Controllers\Controller;

class RegistryStudentController extends Controller
{
    public function schedule()
    {
        $thisYear = Date('Y');
        $gelombang1 = StudentRegistrySchedule::where('tahun', $thisYear)->where('kategori', 'Gelombang 1')->first();
        $gelombang2 = StudentRegistrySchedule::where('tahun', $thisYear)->where('kategori', 'Gelombang 2')->first();
        
        return view('registry-student.schedule', compact('gelombang1','gelombang2'));
    }

    public function storeSchedule(Request $request)
    {
        $year = Date('Y');
        $createSchedule = StudentRegistrySchedule::updateOrCreate(
            ['tahun' => $year, 'kategori'=> $request->kategori],
            ['mulai' => $request->mulai, 'akhir' => $request->akhir]
        );

        return redirect('/registry-schedule')->with('status','Waktu Pendaftaran Berhasil Diatur');
    }

    public function studentsRegistered()
    {
        $year = Date('Y');
        $students = Student::where('status', 'menunggu')->where('tahun_masuk', $year)->get();
        // dd($students->isNotEmpty());
        return view('registry-student.registered', compact('students'));
    }

    public function acceptStudent(Request $request)
    {
        $updateStudent = Student::find($request->id)->update([
            'status' => ''
        ]);

        return redirect('/registered-students')->with('status','Siswa Telah Diterima');
    }

    public function rejectStudent(Request $request)
    {
        $updateStudent = Student::find($request->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/registered-students')->with('status','Siswa Telah Ditolak');
    }

    public function acceptedStudent()
    {
        $year = Date('Y');
        $students = Student::where('tahun_masuk', $year)->where('status','')->get();
        // dd($student);
        return view('registry-student.accepted', compact('students'));
    }

    public function rejectedStudent()
    {
        $year = Date('Y');
        $students = Student::where('tahun_masuk', $year)->where('status', 'ditolak')->get();
        return view('registry-student.rejected', compact('students'));
    }

    public function cancelAcceptStudent(Request $request)
    {
        $updateStudent = Student::find($request->id)->update([
            'status' => 'menunggu'
        ]);

        return redirect('/registered-students');        
    }
}
