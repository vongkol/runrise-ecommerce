<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AboutUsController extends Controller
{
    public function index()
    {
        // var_dump(Auth::user()->email);
        // die();
        if(Auth::user()==null)
        {
            return redirect('/login');
        }
        return view('about');
    }
}
