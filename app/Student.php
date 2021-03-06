<?php

namespace App;

use App\SubLevel;
use App\Helpers\YearHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function levelstudent(){
        return $this->hasMany('App\LevelStudent');
    }

    public static function dataSiswa($sublevelId)
    {
        $sublevel = SubLevel::find($sublevelId);

        $semester = YearHelper::thisSemester();
        $sublevelstudents = DB::table('sub_level_students')
                                ->join('level_students','level_students.id','=','sub_level_students.level_student_id')
                                ->join('students','students.id','=','level_students.student_id')
                                ->where('level_students.year_id',$semester->year_id)
                                ->where('level_students.level_id',$sublevel->level_id)
                                ->where('sub_level_students.sub_level_id', $sublevel->id)
                                ->select('students.nama','students.jenis_kelamin','students.tempat_lahir','students.tgl_lahir')
                                ->get();

        return $sublevelstudents;
    }

    public function scoreSocialStudent()
    {
        return $this->hasMany('App\ScoreSocialStudent');
    }

    public function scoreSpiritualStudent()
    {
        return $this->hasMany('App\ScoreSpiritualStudent');
    }

    public function scoreKnowlegdeCompetence(){
        return $this->hasMany('App\ScoreKnowlegdeCompetence');
    }

    public function extraScore(){
        return $this->hasMany('App\ExtracurricularPeriodScore');
    }

    public function advice(){
        return $this->hasMany('App\Advice');
    }

    public function absent(){
        return $this->hasMany('App\Absent');
    }

    public function uplevel(){
        return $this->hasMany('App\UpLevel');
    }

    public function rank(){
        return $this->hasMany('App\Rank');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function entrypayment(){
        return $this->hasMany('App\EntryPayment');
    }

    public function creditpayment(){
        return $this->hasMany('App\CreditPayment');
    }

    public function monthlypayment(){
        return $this->hasMany('App\MonthlyPayment');
    }

    public function creditmonthlypayment(){
        return $this->hasMany('App\CreditMonthlyPayment');
    }

    public function bookpayment(){
        return $this->hasMany('App\BookPayment');
    }
}
