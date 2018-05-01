<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['roles'] = DB::table('roles')
        ->where('active',1)
        ->paginate(18);
        return view('admins.roles.index', $data);
    }

    function save($cp, Request $r){
        $i = DB::table('roles')->insert(['name' => $r->name]);

        if($i){
            $r->session()->flash('smss','Task was successful!');
            if($cp < 2){
                return redirect('/admin/role');
            }else{
                return redirect('/admin/role?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf','Task was failed!');
            if($cp < 2){
                return redirect('/admin/role')->withinput();
            }else{
                return redirect('/admin/role?page=' . $cp)->withinput();
            }
        }
    }

    function edit($id, $cp){
        $data = DB::table('roles')
        ->where('active', 1)
        ->where('id', $id)
        ->first();

        session()->flash('rlid', $data->id);
        session()->flash('rlname', $data->name);
        if($cp < 2){
            return redirect('/admin/role');
        }else{
            return redirect('/admin/role?page=' . $cp);
        }
    }

    function update($id, $cp, Request $r){
        $i = DB::table('roles')
        ->where('active', 1)
        ->where('id', $id)
        ->update(['name' => $r->name]);

        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/role');
            }else{
                return redirect('/admin/role?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/role/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('roles')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/role');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/role?page='.($cp-1));
            }else{
                return redirect('/admin/role?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/role?page='.$cp);
        }
    }
}
