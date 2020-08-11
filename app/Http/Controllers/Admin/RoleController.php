<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:SUPER ADMIN']);
    }

    public function index(){
        $roles = Role::all();
        return view('roles.index',['roles' => $roles]);
    }

    public function store(Request $request){
        $role = Role::create(['name' => $request->nama]);
        return redirect('/roles')->with('status','Role Baru Berhasil Ditambahkan');
    }

    public function destroy(Role $role){
        Role::destroy($role->id);
        return redirect('/roles')->with('status','Role Baru Berhasil Ditambahkan');
    }

    public function specialRoles(){
        $hasRoles = DB::table('model_has_roles')
                    ->join('roles','roles.id','=','model_has_roles.role_id')
                    ->where('roles.name',"ADMIN")
                    ->get();
        // dd($hasRoles);
        $users = User::where('status','staff')->get();
        return view('roles.special-roles',compact('hasRoles','users'));
    }

    public function storeModelRole(Request $request){
        $user = User::find($request->user);
        $user->assignRole('ADMIN');
        return redirect('/special-roles')->with('status','Role Baru Untuk User Berhasil Ditambahkan');
    }
}
