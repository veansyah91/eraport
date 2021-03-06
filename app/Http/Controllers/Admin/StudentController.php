<?php

namespace App\Http\Controllers\Admin;

use File;
use App\User;
use App\Year;
use App\Level;
use App\Student;
use App\Semester;
use App\SubLevel;
use App\LevelStudent;
use GuzzleHttp\Client;
use App\Helpers\YearHelper;
use Illuminate\Http\Request;
use App\Exports\RekapDataSiswa;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Auth\RegistersUsers;

use PDF;

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
        //cek status kenaikan kelas
        $students = Student::all();
        $semuaSemester = Semester::all();
        $totalSemester = count($semuaSemester);
        $semesterSebelumnya = $semuaSemester[$totalSemester-2];
        $semesterSekarang = $semuaSemester[$totalSemester-1];
        

        if ($semesterSebelumnya->semester == "GENAP") {
            // dd($semesterSebelumnya);
            foreach ($students as $student) {
                
                $kelasTerakhir = DB::table('level_students')
                                    ->join('levels','levels.id','=','level_students.level_id')
                                    ->where('level_students.student_id',$student->id)
                                    ->where('level_students.year_id',$semesterSebelumnya->year->id)
                                    ->first();

                if ($kelasTerakhir) {
                    $kelasSekarang = DB::table('levels')
                                    ->where('kelas', $kelasTerakhir->kelas + 1)
                                    ->first();

                    $statusNaikKelas = DB::table('up_levels')
                                        ->where('student_id',$student->id)
                                        ->where('semester_id',$semesterSebelumnya->id)
                                        ->first();

                    $cekKelasSekarang = DB::table('level_students')
                                        ->where('year_id',$semesterSekarang->year->id)
                                        ->where('student_id',$student->id)
                                        ->first();                

                    if ($statusNaikKelas){
                        $status = $statusNaikKelas->status;
                        if (!$cekKelasSekarang) {
                            if ($status == 1) {
                                DB::table('level_students')->insertOrIgnore([
                                    ['year_id' => $semesterSekarang->year->id, 'student_id' => $student->id, 'level_id' => $kelasSekarang->id,'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
                                ]);
                            }else{
                                DB::table('level_students')->insertOrIgnore([
                                    ['year_id' => $semesterSekarang->year->id, 'student_id' => $student->id, 'level_id' => $kelasTerakhir->level_id,'created_at' => date('y-m-d h:i:sa'),'updated_at' => date('y-m-d h:i:sa')],
                                ]);
                            }
                        }                    
                    }
                }
            }
        }
        
    }

    public function index()
    {
        $levels = Level::all();
        return view('students.index',compact('levels'));
    }

    public function show(Student $student){
        $levels = Level::all();
        $year = YearHelper::thisSemester()->year_id;

        
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
        $levels = Level::all();
        return view('students.tambah',compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
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
            'no_hp' => 'required',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $student = new Student;
        $student->nik = $request->nik;
        $student->no_induk = $request->no_induk;
        $student->nisn = $request->nisn;
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
        
        if ($request->hasFile('image')) {
            $request->file('image')->move('img/student/', $request->file('image')->getClientOriginalName());
            $student->image = $request->file('image')->getClientOriginalName();
        };
        $student->save();

        $year = YearHelper::thisSemester()->year_id;

        $levelstudent = new LevelStudent;
        $levelstudent->student_id = $student->id;
        $levelstudent->level_id = $request->kelas_sekarang;
        $levelstudent->year_id = $year;
        $levelstudent->save();

        return redirect('/students')->with('status','Data Siswa Berhasil Ditambahkan');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'no_induk' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tahun_masuk' => 'numeric',
            'agama' => 'required',
            'nama_ibu' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_ayah' => 'required',
            'pendidikan_ibu' => 'required',
            'anak_ke' => 'required',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        Student::where('id',$student->id)
                ->update([
                    'nik' => $request->nik,
                    'nama' => strtoupper($request->nama),
                    'nisn' => $request->nisn,
                    'tempat_lahir' => strtoupper($request->tempat_lahir),
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'no_induk' => $request->no_induk,
                    'tinggi_badan' => $request->tinggi_badan,
                    'berat_badan' => $request->berat_badan,
                    'hobi' => $request->hobi,
                    'tahun_masuk' => $request->tahun_masuk,
                    'sekolah_sebelumnya' => strtoupper($request->sekolah_sebelumnya),
                    'anak_ke' => $request->anak_ke,
                    'nama_ayah' => strtoupper($request->nama_ayah),
                    'nama_ibu' => strtoupper($request->nama_ibu),
                    'pekerjaan_ayah' => strtoupper($request->pekerjaan_ayah),
                    'pekerjaan_ibu' => strtoupper($request->pekerjaan_ibu),
                    'pendidikan_ayah' => strtoupper($request->pendidikan_ayah),
                    'pendidikan_ibu' => strtoupper($request->pendidikan_ibu),
                    'jarak_rumah' => $request->jarak_rumah,
                    'jalan' => $request->jalan,
                    'desa' => $request->desa,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'provinsi' => $request->provinsi,
                    'kode_pos' => $request->kode_pos,     
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
            return getUserStudent($s->id) ? "Telah Diatur" : "-";
        })
        ->addColumn('aksi',function($s){
            return getUserStudent($s->id) 
                ? '<a href="/reset-student-password/'. getUserStudent($s->id)->id .'" class="btn btn-sm btn-success">Reset Password</a><a href="/edit-student-email/'. getUserStudent($s->id)->id .'" class="btn btn-sm btn-primary">Ubah Email</a>' 
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

    public function emailEdit(User $user){

        return view('students.email-update',compact('user'));
    }

    public function emailUpdate(User $user, Request $request){
        User::where('id', $user->id)
            ->update(['email' => $request->email,]);
        return redirect('/registry-student/')->with('status','Ubah Email Berhasil');
    }

    public function printDataStudent($sublevel)
    {
        $subleveldetail = SubLevel::find($sublevel);
        $semester = YearHelper::thisSemester();
        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('level_students.year_id',$semester->year_id)
                                ->where('level_students.level_id',$subleveldetail->level_id)
                                ->where('sub_level_students.sub_level_id', $subleveldetail->id)
                                ->select('students.nama','students.jenis_kelamin','students.tempat_lahir','students.tgl_lahir', 'students.jalan','students.nik')
                                ->get();

        $pdf = PDF::loadView('students.print-data-student',['subleveldetail' => $subleveldetail, 'semester'=>$semester, 'sublevelstudents' => $sublevelstudents], ['format' => 'A5-L']);
        return $pdf->download('Data-siswa-kelas-'. $subleveldetail->level->kelas . $subleveldetail->alias . '.pdf');
    }
}
