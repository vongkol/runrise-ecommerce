<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        $data['categories'] = DB::table('categories as c1')
        ->Leftjoin('categories as c2','c1.parent_id','c2.id')
        ->where('c1.active',1)
        ->orderBy('c1.id','desc')
        ->select('c1.*','c2.name as parent_name')
        ->paginate(18); 
        return view('admins.categories.index', $data);
    }

    // new data form
    function create(){
        $data['categories'] = DB::table('categories')
        ->where('active',1)
        ->where('parent_id',0)
        ->get();
        return view('admins.categories.create', $data);
    }

    function save(Request $r){
        $data = array(
            'name' => $r->name,
            'parent_id' => $r->parent_id
        );

        $i = DB::table('categories')->insertGetId($data);
        
        if($r->icon || $r->hasFile('icon')){
            $file = $r->file('icon');
            $file_name = date('YmdHis') . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/categories/";
            $file->move($destinationPath, $file_name);

            $i = DB::table('categories')
            ->where('id', $i)
            ->update(['icon' => $file_name]);

            if($i){
                $r->session()->flash('smss',"New categories has been created successfully");
                return redirect('admin/categories/create');
            }else{
                $r->session()->flash('smsf',"Fail to create new categories");
                return redirect('admin/categories/create');
            }
        }

        if($i){
            $r->session()->flash('smss',"New categories has been created successfully");
            return redirect('admin/categories/create');
        }else{
            $r->session()->flash('smsf',"Fail to create new categories");
            return redirect('admin/categories/create');
        }
    }

    function edit($id, $cp){
        $data['category'] = DB::table('categories')
        ->where('active', 1)
        ->where('id', $id)
        ->first();
        $data['categories'] = DB::table('categories')
        ->where('active', 1)
        ->where('parent_id', 0)
        ->get();
        $data['pgnum'] = $cp;
        return view('admins.categories.edit', $data);
    }

    function update($id, $cp, Request $r){
        $data = array(
            'name' => $r->name,
            'address' => $r->address,
            'phone' => $r->phone,
            'email' => $r->email
        );

        $i = DB::table('categories')
        ->where('active', 1)
        ->where('id', $id)
        ->update($data);

        if(($r->icon || $r->hasFile('icon')) && $i){
            $file = $r->file('icon');
            $file_name = date('YmdHis') . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/categories/";
            $file->move($destinationPath, $file_name);

            $i = DB::table('categories')
            ->where('id', $id)
            ->update(['icon' => $file_name]);

            if($i){
                $r->session()->flash('smss', 'Task was successful!');
                if($cp < 2){
                    return redirect('/admin/category');
                }else{
                    return redirect('/admin/category?page=' . $cp);
                }
            }else{
                $r->session()->flash('smsf', 'Task was failed!');
                return redirect('/admin/category/edit/'. $id . '/' . $cp);
            }
        }
        
        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/category');
            }else{
                return redirect('/admin/category?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/category/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('categories')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/category');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/category?page='.($cp-1));
            }else{
                return redirect('/admin/category?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/category?page='.$cp);
        }
    }
}
