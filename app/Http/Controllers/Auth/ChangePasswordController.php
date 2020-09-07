<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index(){
        return view('auth.passwords.change');
    }

    public function update(Request $request){
        // dd($request);
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        User::where('id', Auth::user()->id)
            ->update(['password' => Hash::make($request->password)]);
        return redirect('/')->with('status','Password Berhasil Diubah');
    }
}
