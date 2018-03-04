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
    public function index()
    {
        $data['users'] = DB::table('users')->paginate(18);
        return view('admins.users.index', $data);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
