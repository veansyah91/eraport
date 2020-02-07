<?php

namespace App\Http\Controllers;

use App\Level;
use App\SubLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LevelController extends Controller
{
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
        $sublevel = DB::table('sub_levels')->where('level_id', $level->id)->get();
        return view('classes.subclasses.index',compact('level','sublevel'));
    }

    public function deleteSublevel(Level $level, SubLevel $sublevel)
    {
        SubLevel::destroy($sublevel->id);
        return redirect('/classes/'.$level->id)->with('status','Sub Kelas Berhasil Dihapus');
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
        // dd($level->jumlah+$request->jumlah);
    }

    public function destroy(Level $level)
    {
        //
    }
}
