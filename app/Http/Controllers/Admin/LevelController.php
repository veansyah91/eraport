<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HomeRoomTeacher;
use App\Level;
use App\LevelSubject;
use App\LevelSubjectTeachers;
use App\SubLevel;
use App\SubLevelStudent;
use App\Semester;
use App\Social;
use App\SocialPeriod;
use App\Spiritual;
use App\SpiritualPeriod;
use App\Subject;
use App\Year;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


function addLevelSubectTeacherAuto($level,$semester){
    $levelsubjects = DB::table('level_subjects')
                        ->where('level_id',$level)
                        ->where('semester_id',$semester)
                        ->get();

    $sublevels = DB::table('sub_levels')
                    ->where('level_id',$level)
                    ->get();

    foreach ($levelsubjects as $levelsubject) {
        foreach ($sublevels as $sublevel) {
            $cek = DB::table('level_subject_teachers')  
                    ->where('level_subject_id',$levelsubject->id)
                    ->where('sub_level_id',$sublevel->id)
                    ->get();
                    
            if (count($cek)<1) {
                $levelsubjectteacher = new LevelSubjectTeachers;
                $levelsubjectteacher->level_subject_id = $levelsubject->id;
                $levelsubjectteacher->sub_level_id = $sublevel->id;
                $levelsubjectteacher->save();
            }
        }
    }
}

class UnselectSocial{
    public $id;
    public $aspek;

    function set_id($id){
        $this->id = $id;
    }

    function set_aspek($aspek){
        $this->aspek = $aspek;
    }
}

class UnselectSpiritual{
    public $id;
    public $aspek;

    function set_id($id){
        $this->id = $id;
    }

    function set_aspek($aspek){
        $this->aspek = $aspek;
    }
}

class UnselectSubject{
    public $id;
    public $mata_pelajaran;
    public $kategori;

    function set_id($id){
        $this->id = $id;
    }

    function set_mata_pelajaran($mata_pelajaran){
        $this->mata_pelajaran = $mata_pelajaran;
    }

    function set_kategori($kategori){
        $this->kategori = $kategori;
    }

    
}

class LevelController extends Controller
{
    public function __construct(){
        //tambah tahun ajaran otomatis
        checkyear();
        
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
        $alllevelsubject = LevelSubject::all();
        $levelsubject = DB::table('level_subjects')
                        ->where('semester_id','=',$semester->id)
                        ->get();

        //tambah mata pelajaran per kelas tiap tahun ajaran secara otomatis
        if ($alllevelsubject->isNotEmpty() && $levelsubject->isEmpty()) {
            $totalData = count($semesters);
            $nowsemester = $semesters[$totalData-1];
            $copyData = $semesters[$totalData-2];
            $temp = DB::table('level_subjects')
                        ->where('semester_id','=',$copyData->id)
                        ->get();
            for ($i=0; $i < count($temp); $i++) { 
                $levelsubjects = new LevelSubject;
                $levelsubjects->semester_id = $nowsemester->id;
                $levelsubjects->level_id = $temp[$i]->level_id;
                $levelsubjects->subject_id = $temp[$i]->subject_id;
                $levelsubjects->save();

                addLevelSubectTeacherAuto($temp[$i]->level_id,$nowsemester->id);

            };
        }

    }

    

    public function index()
    {
        return view('classes.index');
    }

    public function create()
    {
        $kelas = 0;
        $jumlah = 1;
        for ($i=1; $i < 7 ; $i++) { 
            $kelas ++;
            $level = new Level;
            $level->kelas = $kelas;
            $level->jumlah = $jumlah;
            $level->save();
        };
        
        $levels = Level::all();
        $alias=1;
        foreach ($levels as $level) {
            $sublevel = new SubLevel;
            $sublevel->level_id = $level->id;
            $sublevel->alias = $alias;
            $sublevel->save();
        }

        return redirect('/students')->with('status','Kelas Berhasil Diatur');
    }

    public function indexSubLevel(Level $level)
    {
        $subjects = Subject::all();
        $semesters = Semester::all(); 
        $semester = last(last($semesters));
        $sublevel = DB::table('sub_levels')->where('level_id', $level->id)->get();
        $tempLevel = $level->id;
        $levelsubject = DB::table('level_subjects')
                        ->join('levels', 'level_subjects.level_id','=','levels.id')
                        ->join('subjects','level_subjects.subject_id','=','subjects.id')
                        ->where('levels.id',$level->id)
                        ->where('level_subjects.semester_id',$semester->id)
                        ->select('level_subjects.id','level_subjects.kkm','level_subjects.subject_id','levels.kelas','subjects.mata_pelajaran','subjects.kategori','subjects.sub_of')
                        ->get();        
                        
        
        $unselectSubject = [];
        $ada = false;
        $i = 0;
        foreach ($subjects as $subject) {
            foreach ($levelsubject as $ls) {
                if ($subject->id == $ls->subject_id) {
                    $ada = true;
                }
            }
            if ($ada == false){
                $unselectSubject[$i] = new UnselectSubject;
                $unselectSubject[$i]->set_id($subject->id);
                $unselectSubject[$i]->set_mata_pelajaran($subject->mata_pelajaran);
                $unselectSubject[$i]->set_kategori($subject->kategori);
                $i++;
            }
            $ada = false;
        }
        
        $walikelas = DB::table('home_room_teachers')
                        ->join('years','home_room_teachers.year_id','=','years.id')
                        ->join('staff','home_room_teachers.staff_id','=','staff.id')
                        ->join('sub_levels','home_room_teachers.sub_level_id','=','sub_levels.id')
                        ->where('home_room_teachers.year_id',$semester->year_id)
                        ->where('sub_levels.level_id',$level->id)
                        ->select('home_room_teachers.*','staff.nama')
                        ->get();

        $guru = DB::table('staff_periods')
                    ->join('positions','positions.id','=','staff_periods.position_id')
                    ->join('staff','staff.id','=','staff_periods.staff_id')
                    ->join('semesters','semesters.id','=','staff_periods.semester_id')
                    ->where('positions.jabatan','GURU')
                    ->where('semesters.id',$semester->id)
                    ->select('staff_periods.id','staff_periods.staff_id','staff.nama')
                    ->get();

        $levelsubjectteachers = DB::table('level_subject_teachers')
                                ->join('level_subjects','level_subject_teachers.level_subject_id','=','level_subjects.id')
                                ->join('subjects','level_subjects.subject_id','=','subjects.id')
                                ->where('level_subjects.semester_id',$semester->id)
                                ->select('level_subject_teachers.*','subjects.mata_pelajaran','subjects.kategori')
                                ->get();

        $levelstudents = DB::table('level_students')
                            ->join('students','students.id','=','level_students.student_id')
                            ->where('level_students.level_id',$level->id)
                            ->where('level_students.year_id',$semester->year_id)
                            ->select('level_students.*','students.nama')
                            ->get();

        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('level_students.year_id',$semester->year_id)
                                ->where('level_students.level_id',$level->id)
                                ->select('sub_level_students.id','sub_level_students.level_student_id','students.nama','sub_level_students.sub_level_id')
                                ->get();
        $socials = Social::all();
        $unselectsocials=[];

        $socialperiods=DB::table('social_periods')
                            ->join('socials','socials.id','=','social_periods.social_id')
                            ->where('social_periods.level_id',$level->id)
                            ->where('social_periods.semester_id',$semester->id)
                            ->select('social_periods.id','social_periods.social_id','socials.aspek')
                            ->get();
        $i = 0;
        $ada = false;
        foreach ($socials as $social) {
            foreach ($socialperiods as $socialperiod) {
                if ($social->id == $socialperiod->social_id) {
                    $ada = true;
                }
            }

            if ($ada == false) {
                $unselectsocials[$i] = new UnselectSocial;
                $unselectsocials[$i]->set_id($social->id);
                $unselectsocials[$i]->set_aspek($social->aspek);
                $i++;
            }

            $ada = false;
        }

        $spirituals = Spiritual::all();
        $unselectspirituals=[];

        $spiritualperiods=DB::table('spiritual_periods')
                            ->join('spirituals','spirituals.id','=','spiritual_periods.spiritual_id')
                            ->where('spiritual_periods.level_id',$level->id)
                            ->where('spiritual_periods.semester_id',$semester->id)
                            ->select('spiritual_periods.id','spiritual_periods.spiritual_id','spirituals.aspek')
                            ->get(); 

        foreach ($spirituals as $spiritual) {
            foreach ($spiritualperiods as $spiritualperiod) {
                if ($spiritual->id == $spiritualperiod->spiritual_id) {
                    $ada = true;
                }
            }

            if ($ada == false) {
                $unselectspirituals[$i] = new UnselectSpiritual;
                $unselectspirituals[$i]->set_id($spiritual->id);
                $unselectspirituals[$i]->set_aspek($spiritual->aspek);
                $i++;
            }

            $ada = false;
        }

        return view('classes.subclasses.index',compact('level','sublevel','levelsubject','unselectSubject','semester','walikelas','guru','levelsubjectteachers','levelstudents','sublevelstudents','spiritualperiods','socialperiods','unselectspirituals','unselectsocials'));
    }

    public function deleteSublevel(Level $level, SubLevel $sublevel)
    {
        SubLevel::destroy($sublevel->id);
        Level::where('id',$level->id)
                ->update([
                    'jumlah'=>$level->jumlah - 1
                ]);

        return redirect('/classes/'.$level->id)->with('status','Sub Kelas Berhasil Dihapus');
    }

    public function deleteLevelSubject( Level $level, LevelSubject $levelsubject)
    {
        LevelSubject::destroy($levelsubject->id);
        return redirect('/classes/'.$level->id)->with('status','Mata Pelajaran Berhasil Dihapus');
    }

    public function updateAliasSublevel(Request $request, Level $level, SubLevel $sublevel)
    {   
        SubLevel::where('id',$sublevel->id)
                    ->update([
                        'alias' => $request->alias
                    ]);
        return redirect('/classes/'.$level->id)->with('status','Nama Sub Kelas Berhasil Diubah');
    }

    public function updateSublevel(Request $request, Level $level)
    {
        Level::where('id',$level->id)
                ->update([
                    'jumlah'=>$request->jumlah + $level->jumlah
                ]);
        $jmlSubLevel = count(SubLevel::where('level_id', $level->id)->get());
        for ($i=0; $i < $request->jumlah; $i++) { 
            $jmlSubLevel++;
            $sublevel = new SubLevel;
            $sublevel->level_id = $level->id;
            $sublevel->alias = $jmlSubLevel;
            $sublevel->save();
        }
        
        return redirect('/classes/'.$level->id)->with('status','Jumlah Kelas Berhasil Ditambah');
    }

    public function storeLevelSubject(Request $request, Level $level, Semester $semester){
        foreach ($request->mapel as $mapel) {
            $levelsubject = new LevelSubject;
            $levelsubject->level_id = $level->id;
            $levelsubject->subject_id = $mapel;
            $levelsubject->semester_id = $semester->id;
            $levelsubject->kkm = 70;

            $levelsubject-> save();
        }

        addLevelSubectTeacherAuto($level->id,$semester->id);        

        return redirect('/classes/'.$level->id)->with('status','Mata Pelajaran Berhasil Ditambahkan');
    }

    public function addWalikelas(Request $request, SubLevel $sublevel, Year $year){
        

        $walikelas = new HomeRoomTeacher;
        $walikelas->sub_level_id = $sublevel->id;
        $walikelas->year_id = $year->id;
        $walikelas->staff_id = $request->guruselect;
        $walikelas->save();

        

        return redirect('/classes/'.$sublevel->level_id)->with('status','Walikelas Berhasil Diatur');
    }

    public function editWalikelas(Request $request,SubLevel $sublevel, HomeRoomTeacher $homeroomteacher){
        HomeRoomTeacher::where('id',$homeroomteacher->id)
                        ->update([
                            'staff_id' => $request->guruselect
                        ]);

        return redirect('/classes/'.$sublevel->level_id)->with('status','Walikelas Berhasil Diubah');
    }

    public function editGuruMataPelajaran(Request $request,SubLevel $sublevel, LevelSubjectTeachers $levelsubjectteacher){
        LevelSubjectTeachers::where('id',$levelsubjectteacher->id)
                            ->update([
                                'staff_id' => $request->guruselect
                            ]);
        
        return redirect('/classes/'.$sublevel->level_id)->with('status','Guru Mata Pelajaran Berhasil Diubah');
    }

    public function addGuruMataPelajaran(Request $request,SubLevel $sublevel, LevelSubject $levelsubject){
        $levelsubjectteacher = new LevelSubjectTeachers;
        $levelsubjectteacher->level_subject_id = $levelsubject->id;
        $levelsubjectteacher->sub_level_id = $sublevel->id;
        $levelsubjectteacher->staff_id = $request->guruselect;
        $levelsubjectteacher->save();
        
        return redirect('/classes/'.$sublevel->level_id)->with('status','Guru Mata Pelajaran Berhasil Diubah');
    }

    public function addStudentSubLevel(Request $request, Level $level){
        $sublevelstudent = new SubLevelStudent;
        $sublevelstudent->level_student_id = $request->levelstudent;
        $sublevelstudent->sub_level_id = $request->subkelasselect;
        $sublevelstudent->save();

        return redirect('/classes/'.$level->id)->with('status','Sub Kelas Siswa Berhasil Diatur');
    }

    public function editStudentSubLevel(Request $request, Level $level, SubLevelStudent $sublevelstudent){ 
        SubLevelStudent::where('id',$sublevelstudent->id)
                        ->update([
                            'sub_level_id' => $request->subkelasselect
                        ]);
        

        return redirect('/classes/'.$level->id)->with('status','Sub Kelas Siswa Berhasil Diubah');
    }

    public function addSpiritualPeriod(Request $request, Level $level, Semester $semester){
        foreach ($request->spiritual as $spiritual) {
            $spiritualperiod = new SpiritualPeriod;
            $spiritualperiod->spiritual_id = $spiritual;
            $spiritualperiod->level_id = $level->id;
            $spiritualperiod->semester_id = $semester->id;
            $spiritualperiod->save();
        }

        return redirect('/classes/'.$level->id)->with('status','Aspek Spiritual Berhasil Ditambah');
    }

    public function addSocialPeriod(Request $request, Level $level, Semester $semester){
        foreach ($request->social as $social) {
            $socialperiod = new SocialPeriod;
            $socialperiod->social_id = $social;
            $socialperiod->level_id = $level->id;
            $socialperiod->semester_id = $semester->id;
            $socialperiod->save();
        }

        return redirect('/classes/'.$level->id)->with('status','Aspek Sosial Berhasil Ditambah');
    }

    public function deleteSpiritualPeriod( Level $level, SpiritualPeriod $spiritualperiod)
    {
        SpiritualPeriod::destroy($spiritualperiod->id);
        return redirect('/classes/'.$level->id)->with('status','Aspek Spiritual Berhasil Dihapus');
    }

    public function deleteSocialPeriod( Level $level, SocialPeriod $socialperiod)
    {
        SocialPeriod::destroy($socialperiod->id);
        return redirect('/classes/'.$level->id)->with('status','Aspek Sosial Berhasil Dihapus');
    }
}
