<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class ShopController extends Controller
{
    //
    function __construct(){
        $this->middleware('auth');
    }

    function index(){
        $data['shops'] = DB::table('shops')
        ->where('active',1)
        ->orderBy('id','desc')
        ->paginate(18);

        return view('admins.shops.index', $data);
    }

    function create(){
        return view('admins.shops.create');
    }

    function save(Request $r){
        $data = array(
            'name' => $r->name,
            'address' => $r->address,
            'phone' => $r->phone,
            'email' => $r->email
        );

        $i = DB::table('shops')->insertGetId($data);
        
        if($r->logo || $r->hasFile('logo')){
            $file = $r->file('logo');
            $file_name = date('YmdHis') . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/shops/";
            $file->move($destinationPath, $file_name);

            $i = DB::table('shops')
            ->where('id', $i)
            ->update(['logo' => $file_name]);

            if($i){
                $r->session()->flash('smss',"New Shop has been created successfully");
                return redirect('admin/shop/create');
            }else{
                $r->session()->flash('smsf',"Fail to create new shop");
                return redirect('admin/shop/create');
            }
        }
    }

    function edit($id, $cp){
        $data['shop'] = DB::table('shops')
        ->where('active', 1)
        ->where('id', $id)
        ->first();
        $data['pgnum'] = $cp;
        return view('admins.shops.edit', $data);
    }

    function update($id, $cp, Request $r){
        $data = array(
            'name' => $r->name,
            'address' => $r->address,
            'phone' => $r->phone,
            'email' => $r->email
        );

        $i = DB::table('shops')
        ->where('active', 1)
        ->where('id', $id)
        ->update($data);

        if(($r->logo || $r->hasFile('logo')) && $i){
            $file = $r->file('logo');
            $file_name = date('YmdHis') . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/shops/";
            $file->move($destinationPath, $file_name);

            $i = DB::table('shops')
            ->where('id', $id)
            ->update(['logo' => $file_name]);

            if($i){
                $r->session()->flash('smss', 'Task was successful!');
                if($cp < 2){
                    return redirect('/admin/shop');
                }else{
                    return redirect('/admin/shop?page=' . $cp);
                }
            }else{
                $r->session()->flash('smsf', 'Task was failed!');
                return redirect('/admin/shop/edit/'. $id . '/' . $cp);
            }
        }
        
        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/shop');
            }else{
                return redirect('/admin/shop?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/shop/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('shops')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/shop');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/shop?page='.($cp-1));
            }else{
                return redirect('/admin/shop?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/shop?page='.$cp);
        }
    }
}
