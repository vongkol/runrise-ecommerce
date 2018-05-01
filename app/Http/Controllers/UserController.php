<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function index()
    {
        $data['users'] = DB::table('users')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->select('users.*', 'roles.name as role')
        ->where('users.active',1)
        ->where('users.id','<>', Auth::id())
        ->paginate(18);
        return view('admins.users.index', $data);
    }

    function create(){
        $data['roles'] = DB::table('roles')
        ->where('active',1)
        ->get();
        return view('admins.users.create', $data);
    }
    
    function save(Request $r){
        if($r->password != $r->confirm){
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/user/edit/'. $id . '/' . $cp);
        }

        $data = array(
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'name' => $r->name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'role_id' => $r->role_id
        );

        $i = DB::table('users')->insert($data);

        if($i){
            $r->session()->flash('smss','Task was successful!');
            return redirect('/admin/user/create');
        }else{
            $r->session()->flash('smsf','Task was failed!');
            return redirect('/admin/user/create')->withinput();
        }
    }

    function edit($id, $cp){
        $data['user'] = DB::table('users')
        ->where('active', 1)
        ->where('id', $id)
        ->first();
        
        $data['roles'] = DB::table('roles')
        ->where('active',1)
        ->get();
        $data['pgnum'] = $cp;
        return view('admins.users.edit', $data);
    }

    function update($id, $cp, Request $r){
        if($r->password != $r->confirm){
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/user/edit/'. $id . '/' . $cp);
        }

        if($r->password != '' && $r->password != null){
            $data = array(
                'username' => $r->username,
                'password' => bcrypt($r->password),
                'name' => $r->name,
                'gender' => $r->gender,
                'email' => $r->email,
                'phone' => $r->phone,
                'role_id' => $r->role_id
            );
        }else{
            $data = array(
                'username' => $r->username,
                'name' => $r->name,
                'gender' => $r->gender,
                'email' => $r->email,
                'phone' => $r->phone,
                'role_id' => $r->role_id
            );
        }

        $i = DB::table('users')
        ->where('active', 1)
        ->where('id', $id)
        ->update($data);

        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/user');
            }else{
                return redirect('/admin/user?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/user/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('users')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/user');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/user?page='.($cp-1));
            }else{
                return redirect('/admin/user?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/user?page='.$cp);
        }
    }
}
