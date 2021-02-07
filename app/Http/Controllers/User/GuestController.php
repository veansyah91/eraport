<?php

namespace App\Http\Controllers\User;

use App\Level;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function studentRegitry()
    {
        $levels = Level::all();
        return view('guest.registry' ,compact('levels'));
    }

    public function storeStudentRegitry(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:students',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tinggi_badan' => 'numeric|nullable',
            'berat_badan' => 'numeric|nullable',
            'tahun_masuk' => 'numeric',
            'agama' => 'required',
            'nama_ibu' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_ayah' => 'required',
            'pendidikan_ibu' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'anak_ke' => 'required',
        ]);

        $student = new Student;
        $student->nik = $request->nik;
        $student->nama = strtoupper($request->nama);
        $student->jenis_kelamin = $request->jenis_kelamin;
        $student->tempat_lahir = strtoupper($request->tempat_lahir);
        $student->tgl_lahir = $request->tgl_lahir;
        $student->tinggi_badan = $request->tinggi_badan;
        $student->berat_badan = $request->berat_badan;
        $student->hobi = strtoupper($request->hobi);
        $student->agama = $request->agama;
        $student->tahun_masuk = $request->tahun_masuk;
        $student->sekolah_sebelumnya = strtoupper($request->sekolah_sebelumnya);
        $student->nama_ayah = strtoupper($request->nama_ayah);
        $student->nama_ibu = strtoupper($request->nama_ibu);
        $student->anak_ke = $request->anak_ke;
        $student->pekerjaan_ayah = strtoupper($request->pekerjaan_ayah);
        $student->pekerjaan_ibu = strtoupper($request->pekerjaan_ibu);
        $student->pendidikan_ayah = strtoupper($request->pendidikan_ayah);
        $student->pendidikan_ibu = strtoupper($request->pendidikan_ibu);
        $student->jarak_rumah = $request->jarak_rumah;
        $student->jalan = strtoupper($request->jalan);
        $student->desa = $request->desa;
        $student->kecamatan = $request->kecamatan;
        $student->kabupaten = $request->kabupaten;
        $student->provinsi = $request->provinsi;
        $student->kode_pos = $request->kode_pos;
        $student->kelas = $request->kelas;
        $student->no_hp = $request->no_hp;
        $student->status = 'menunggu';

        $student->save();

        return redirect('/status-registry-student/nik=' . $student->nik);
    }

    public function statusStudentRegistry($nik)
    {
        $student = Student::where('nik', $nik)->first();
        return view('guest.status-registry', compact('student'));
    }

    public function cekStatusStudentRegistry(Request $request)
    {
        return redirect('/status-registry-student/nik=' . $request->nik);
    }
}
