<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;

class YearController extends Controller
{
    public function store(Request $request)
    {
        Year::create($request->all());
        return redirect('/');
    }

    public function destroy($id)
    {
        //
    }
}
