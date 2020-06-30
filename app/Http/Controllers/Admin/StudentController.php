<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\Level;
use App\LevelStudent;
use App\Year;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Support\Facades\Hash;


function getUserStudent($id){
    $user = DB::table('users')
                ->where('student_id',$id)
                ->first();
    return $user;
}

class StudentController extends Controller
{

    public function __construct(){
        checkyear();
    }

    public function index()
    {
        $levels = Level::all();
        return view('students.index',compact('levels'));
    }

    public function show(Student $student){

        $levels = Level::all();
        $years = Year::aLL();
        $year = last(last($years));
        $levelsudents = DB::table('level_students')
                        ->join('levels','levels.id','=','level_students.level_id')
                        ->join('years','years.id','=','level_students.year_id')
                        ->where('level_students.student_id',$student->id)
                        ->select('level_students.*','levels.kelas')
                        ->get();
        $lastyearstudent = DB::table('level_students')
                            ->where('year_id',$year->id)
                            ->where('student_id',$student->id)
                            ->first();
        return view('students.detail',compact('student','levelsudents','year','levels','lastyearstudent'));
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

        $student = Student::where('nik',$request->nik)->first();
        $years = Year::all();
        $year = last($years);

        $levelstudent = new LevelStudent;
        $levelstudent->student_id = $student->id;
        $levelstudent->level_id = $request->kelas_sekarang;
        $levelstudent->year_id = $year[0]->id;
        $levelstudent->save();


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
                    'sekolah_sebelumnya' => $request->pendidikan_terakhir,
                    'anak_ke' => $request->anak_ke,
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
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
        return redirect('/students')->with('status','Data Siswa Berhasil Diubah');
    }

    public function updateprofil(Request $request, Student $student)
    {
        Student::where('id',$student->id)
                ->update([
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'nisn' => $request->nisn,
                    'no_induk' => $request->no_induk,
                ]);

        if ($request->hasFile('image')) {
            File::delete('img/student/'.$student->image);
            $request->file('image')->move('img/student/', $request->file('image')->getClientOriginalName());
            Student::where('id',$student->id)
                ->update([
                    'image' => $request->file('image')->getClientOriginalName()
                ]);
            
        };
        return redirect('/student/'.$student->id)->with('status','Profil Siswa Berhasil Diubah');
    }

    public function updatebiodata(Request $request, Student $student)
    {
        Student::where('id',$student->id)
                ->update([
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tinggi_badan' => $request->tinggi_badan,
                    'berat_badan' => $request->berat_badan,
                    'hobi' => $request->hobi,
                    'anak_ke' => $request->anak_ke,
                ]);
        
        return redirect('/student/'.$student->id)->with('status','Biodata Siswa Berhasil Diubah');
    }

    public function updatebiodataorangtua(Request $request, Student $student)
    {
        Student::where('id',$student->id)
                ->update([
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                ]);
        
        return redirect('/student/'.$student->id)->with('status','Biodata Orang Tua Berhasil Diubah');
    }

    public function updatealamat(Request $request, Student $student)
    {
        Student::where('id',$student->id)
                ->update([
                    'jarak_rumah' => $request->jarak_rumah,
                    'jalan' => $request->jalan,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'kode_pos' => $request->kode_pos,
                ]);
        
        return redirect('/student/'.$student->id)->with('status','Alamat Siswa Berhasil Diubah');
    }

    public function updateriwayatsekolah(Request $request, Student $student, LevelStudent $levelstudent)
    {
        Student::where('id',$student->id)
                ->update([
                    'tahun_masuk' => $request->tahun_masuk,
                    'kelas' => $request->kelas,
                    'sekolah_sebelumnya' => $request->sekolah_sebelumnya,
                ]);

        LevelStudent::where('id',$levelstudent->id)
                    ->update([
                        'level_id' => $request->kelas_sekarang,
                    ]);
        
        return redirect('/student/'.$student->id)->with('status','Riwayat Sekolah Siswa Berhasil Diubah');
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

    public function registry(){
        return view('students.registry');
    }

    public function getuserdatastudent(){
        $students = Student::select('students.*');

        return \DataTables::eloquent($students)
        ->addColumn('email',function($s){
            return getUserStudent($s->id) ? getUserStudent($s->id)->email : "-";
        })
        ->addColumn('password',function($s){
            return getUserStudent($s->id) ? getUserStudent($s->id)->password : "-";
        })
        ->addColumn('aksi',function($s){
            return getUserStudent($s->id) 
                ? '<a href="/reset-student-password/'. getUserStudent($s->id)->id .'" class="btn btn-sm btn-success">Reset Password</a>' 
                : '<a href="/registry-student/'. $s->id .'" class="btn btn-sm btn-success button-registry">
                        Tambah Akun
                   </a>';
        })
        ->rawColumns(['email','password','aksi'])
        ->toJson();
    }

    public function registryAdd(Student $student){
        return view('students.registry-add',compact('student'));
    }

    public function registryStore(Request $request, Student $student){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'student_id' => $student->id,
            'status' => "student",
            'password' => Hash::make('siswasditabubakar'),
        ]);

        return redirect('/registry-student/')->with('status','Registrasi Akun Siswa Berhasil');
    }

    public function registryReset(User $user){
        User::where('id', $user->id)
            ->update(['password' => Hash::make('siswasditabubakar'),]);

        return redirect('/registry-student/')->with('status','Reset Password Berhasil');
    }
}
