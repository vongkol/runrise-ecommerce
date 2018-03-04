<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// dashboard route
Route::get('/admin', "DashboardController@index");

// Route::get('/home', 'HomeController@index')->name('home');
// about use route
Route::get('/about', "AboutUsController@index");
// category
Route::get('/admin/category', function(){
    return view('admins.categories.index');
});

// user route
Route::get('/admin/user', "UserController@index");
Route::get('/user/logout', "UserController@logout");
// page
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
// file manager
Route::get('/admin/filemanager', "FileManagerController@index");