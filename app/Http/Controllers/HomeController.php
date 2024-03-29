<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\StaffPeriod;
use App\Helpers\YearHelper;
use App\Helpers\TeacherHelper;
use App\LevelSubjectTeachers;


class HomeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $tanggal = Date('Y-m-d');
        
        if (Auth::user()->hasRole('SUPER ADMIN')) return redirect('/sekolah');
        return view('users.profile');
    }
}
