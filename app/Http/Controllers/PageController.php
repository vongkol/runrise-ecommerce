<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['pages'] = DB::table('pages')
        ->where('active', 1)
        ->paginate(2);
        return view('admins.pages.index', $data);
    }

    public function create()
    {
        return view('admins.pages.create');
    }

    function save(Request $r){
        $data = array(
            'title' => $r->title,
            'description' => $r->description
        );

        $i = DB::table('pages')->insert($data);

        if($i){
            $r->session()->flash('smss','Task was successful!');
            return redirect('/admin/page/create');
        }else{
            $r->session()->flash('smsf','Task was failed!');
            return redirect('/admin/page/create')->withinput();
        }
    }

    function edit($id, $cp){
        $data['page'] = DB::table('pages')
        ->where('active', 1)
        ->where('id', $id)
        ->first();
        $data['pgnum'] = $cp;
        return view('admins.pages.edit', $data);
    }

    function update($id, $cp, Request $r){
        $data = array(
            'title' => $r->title,
            'description' => $r->description
        );

        $i = DB::table('pages')
        ->where('active', 1)
        ->where('id', $id)
        ->update($data);

        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/page');
            }else{
                return redirect('/admin/page?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/page/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('pages')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/page');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/page?page='.($cp-1));
            }else{
                return redirect('/admin/page?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/page?page='.$cp);
        }
    }
}
