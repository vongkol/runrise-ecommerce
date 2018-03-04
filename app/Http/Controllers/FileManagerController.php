<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class FileManagerController extends Controller
{
    public function index()
    {
        return view('admins.filemans.index');
    }
}
