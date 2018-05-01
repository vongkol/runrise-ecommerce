<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Image;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['products'] = DB::table('products')
        ->leftJoin('categories','products.category_id','categories.id')
        ->leftJoin('shops','products.shop_id','shops.id')
        ->leftJoin('photos','products.id','photos.product_id')
        ->where('products.active', 1)
        ->orderBy('products.id', 'desc')
        ->select('products.id','products.name','products.price','categories.name as category_name','shops.name as shop_name',DB::raw('count(photos.product_id) as num_photo'))
        ->groupBy('products.id','products.name','products.price')
        ->paginate(18);
        return view('admins.products.index', $data);
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')
        ->where('active',1)
        ->orderBy('name')
        ->get();

        $data['shops'] = DB::table('shops')
        ->where('active',1)
        ->orderBy('name')
        ->get();

        return view('admins.products.create', $data);
    }

    function save(Request $r){
        $data = array(
            'name' => $r->name,
            'price' => $r->price,
            'model' => $r->model,
            'discount' => $r->discount,
            'category_id' => $r->category_id,
            'shop_id' => $r->shop_id,
            'short_description' => $r->short_description,
            'description' => $r->description,
        );

        $i = DB::table('products')->insertGetId($data);

        if($r->front_photo || $r->hasFile('front_photo')){
            $file = $r->file('front_photo');
            $file_name = $i . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/products/";
            $file->move($destinationPath, $file_name);

            $ii = DB::table('products')
            ->where('id', $i)
            ->update(['front_photo' => $file_name]);

            if($ii){
                $r->session()->flash('smss',"New product has been created successfully");
                return redirect('admin/product/create');
            }else{
                $r->session()->flash('smsf',"Fail to create new product");
                return redirect('admin/product/create');
            }
        }

        if($i){
            $r->session()->flash('smss',"New product has been created successfully");
            return redirect('admin/product/create');
        }else{
            $r->session()->flash('smsf',"Fail to create new product");
            return redirect('admin/product/create');
        }
    }

    function edit($id, $cp){
        $data['product'] = DB::table('products')
        ->where('active',1)
        ->where('id',$id)
        ->orderBy('name')
        ->first();

        $data['categories'] = DB::table('categories')
        ->where('active',1)
        ->orderBy('name')
        ->get();

        $data['shops'] = DB::table('shops')
        ->where('active',1)
        ->orderBy('name')
        ->get();

        $data['pgnum'] = $cp;
        return view('admins.products.edit', $data);
    }

    function update($id, $cp, Request $r){
        $data = array(
            'name' => $r->name,
            'price' => $r->price,
            'model' => $r->model,
            'discount' => $r->discount,
            'category_id' => $r->category_id,
            'shop_id' => $r->shop_id,
            'short_description' => $r->short_description,
            'description' => $r->description,
        );

        $i = DB::table('products')
        ->where('active', 1)
        ->where('id', $id)
        ->update($data);

        if(($r->front_photo || $r->hasFile('front_photo')) && $i){
            $file = $r->file('front_photo');
            $file_name = date('YmdHis') . "-" . $file->getClientOriginalName();
            $destinationPath = "uploads/products/";
            $file->move($destinationPath, $file_name);

            $i = DB::table('products')
            ->where('id', $id)
            ->update(['front_photo' => $file_name]);

            if($i){
                $r->session()->flash('smss', 'Task was successful!');
                if($cp < 2){
                    return redirect('/admin/product');
                }else{
                    return redirect('/admin/product?page=' . $cp);
                }
            }else{
                $r->session()->flash('smsf', 'Task was failed!');
                return redirect('/admin/product/edit/'. $id . '/' . $cp);
            }
        }
        
        if($i){
            $r->session()->flash('smss', 'Task was successful!');
            if($cp < 2){
                return redirect('/admin/product');
            }else{
                return redirect('/admin/product?page=' . $cp);
            }
        }else{
            $r->session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/product/edit/'. $id . '/' . $cp);
        }
    }

    function delete($id,$cp,$row){
        $i = DB::table('products')
        ->where('active',1)
        ->where('id',$id)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
            if($row-1 == 0 & $cp-1 < 2){
                return redirect('/admin/product');
            }else if($row-1 == 0 & $cp-1 > 1){
                return redirect('/admin/product?page='.($cp-1));
            }else{
                return redirect('/admin/product?page='.$cp);
            }
        }else{
            session()->flash('smsf', 'Task was failed!');
            return redirect('/admin/product?page='.$cp);
        }
    }

    function photo($id, $cp){
        $data['photos'] = DB::table('photos')
        ->where('active',1)
        ->where('product_id',$id)
        ->get();
        $data['cp'] = $cp;
        $data['id'] = $id;
        return view('admins.products.photo',$data);
    }

    public function upload_photo(Request $r)
    {
        if($r->file('photo')) {
            $files = $r->file('photo');
            $prefix = date('YmdHis');
            $counter = DB::table('photos')
            ->where('product_id', $r->id)
            ->count();

            if($counter>=10)
            {
                session()->flash('smsf', 'Task was failed! You can not stores photo more than 10.');
                return redirect('/admin/product/photo/'.$r->id.'/'.$r->cp);
            }

            foreach ($files as $file) {
                $name = $prefix . "-" . $file->getClientOriginalName();
                // upload 540
                $destinationPath = 'uploads/products/540x540/';
                $new_img = Image::make($file->getRealPath())->resize(540, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);

                // upload 250
                $destinationPath = 'uploads/products/250x250/';
                $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);
                // upload 41
                $destinationPath = 'uploads/products/41x41/';
                $new_img = Image::make($file->getRealPath())->resize(41, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);
                $photos = array(
                    'file_name' => $name,
                    'product_id' => $r->id
                );
                $i = DB::table('photos')->insert($photos);

                if($i){
                    session()->flash('smss', 'Task was successful!');
                    ++$counter;
                    if($counter == 10){
                        break;
                    }
                }else{
                    session()->flash('smsf', 
                    'Task was failed! We can upload on Photo Name: '
                    . $file->getClientOriginalName());
                    break;
                }
            }
            return redirect('/admin/product/photo/'.$r->id.'/'.$r->cp);
        }

    }

    public function delete_photo($id, $cp, $pid)
    {
        $i = DB::table('photos')
        ->where('id', $pid)
        ->update(['active' => 0]);

        if($i){
            session()->flash('smss', 'Task was successful!');
        }else{
            session()->flash('smsf', 'Task was failed!');
        }

        return redirect('/admin/product/photo/'.$id.'/'.$cp);
    }
}
