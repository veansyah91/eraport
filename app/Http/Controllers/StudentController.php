<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use File;

class StudentController extends Controller
{

    public function index()
    {
        
        return view('students.index');
    }

    public function create()
    {        
        $client1 = new Client();
        $request = $client1->get('https://x.rajaapi.com/MeP7c5ne'.tokenAPI().'/m/wilayah/provinsi');
        $response = $request->getBody();
        $provinsi = json_decode($response)->data;
        return view('students.tambah',compact('provinsi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:students',
            'no_induk' => 'required|unique:students',
            'nama' => 'required',
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
            'anak_ke' => 'required',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $student = new Student;
        $student->nik = $request->nik;
        $student->no_induk = $request->no_induk;
        $student->nisn = $request->nisn;
        $student->nama = $request->nama;
        $student->jenis_kelamin = $request->jenis_kelamin;
        $student->tempat_lahir = $request->tempat_lahir;
        $student->tgl_lahir = $request->tgl_lahir;
        $student->tinggi_badan = $request->tinggi_badan;
        $student->berat_badan = $request->berat_badan;
        $student->hobi = $request->hobi;
        $student->agama = $request->agama;
        $student->tahun_masuk = $request->tahun_masuk;
        $student->sekolah_sebelumnya = $request->sekolah_sebelumnya;
        $student->nama_ayah = $request->nama_ayah;
        $student->nama_ibu = $request->nama_ibu;
        $student->anak_ke = $request->anak_ke;
        $student->pekerjaan_ayah = $request->pekerjaan_ayah;
        $student->pekerjaan_ibu = $request->pekerjaan_ibu;
        $student->pendidikan_ayah = $request->pendidikan_ayah;
        $student->pendidikan_ibu = $request->pendidikan_ibu;
        $student->jarak_rumah = $request->jarak_rumah;
        $student->jalan = $request->jalan;
        $student->desa = $request->desa;
        $student->kecamatan = $request->kecamatan;
        $student->kabupaten = $request->kabupaten;
        $student->provinsi = $request->provinsi;
        $student->kode_pos = $request->kode_pos;
        $student->kelas = $request->kelas;
        
        if ($request->hasFile('image')) {
            $request->file('image')->move('img/student/', $request->file('image')->getClientOriginalName());
            $student->image = $request->file('image')->getClientOriginalName();
        };
        $student->save();

        return redirect('/students')->with('status','Data Siswa Berhasil Ditambahkan');
    }

    public function update(Request $request, Student $student)
    {
        Student::where('id',$student->id)
                ->update([
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'nisn' => $request->nisn,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'no_induk' => $request->no_induk,
                    'tinggi_badan' => $request->tinggi_badan,
                    'berat_badan' => $request->berat_badan,
                    'hobi' => $request->hobi,
                    'tahun_masuk' => $request->tahun_masuk,
                    'nama_ibu' => $request->nama_ibu,
                    'sekolah_sebelumnya' => $request->pendidikan_terakhir,
                    'nama_ayah' => $request->nama_ayah,
                    'anak_ke' => $request->anak_ke,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'jarak_rumah' => $request->jarak_rumah,
                    'jalan' => $request->jalan,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'kode_pos' => $request->kode_pos,
                    'kelas' => $request->kelas,                    
                ]);

        if ($request->hasFile('image')) {
            File::delete('img/student/'.$student->image);
            $request->file('image')->move('img/student/', $request->file('image')->getClientOriginalName());
            Student::where('id',$student->id)
                ->update([
                    'image' => $request->file('image')->getClientOriginalName()
                ]);
            
        };
        return redirect('/students')->with('status','Data Staff Berhasil Diubah');
    }

    public function destroy(Student $student)
    {
        File::delete('img/'.$student->image);
        Student::destroy($student->id);
        return redirect('/students')->with('status','Data Siswa Berhasil Dihapus');
    }

    public function getdatastudents()
    {
        $students = Student::select('students.*');

        return \DataTables::eloquent($students)
        ->addColumn('ttl',function($s){
            return $s->tempat_lahir.'/'.$s->tgl_lahir;
        })
        ->rawColumns(['ttl'])
        ->toJson();
    }
}
