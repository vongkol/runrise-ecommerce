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

// Route::get('/home', 'HomeController@index')->name('home');

// dashboard route
Route::get('/admin', "DashboardController@index");

// about use route
Route::get('/about', "AboutUsController@index");

// category
Route::get('/admin/category', 'CategoryController@index');
Route::get('/admin/category/create', 'CategoryController@create');
Route::post('/admin/category/save', 'CategoryController@save');
Route::get('/admin/category/edit/{id}/{cp}', 'CategoryController@edit');
Route::get('/admin/category/update/{id}/{cp}', 'CategoryController@update');
Route::get('/admin/category/delete/{id}/{cp}/{row}', 'CategoryController@delete');

// user route
Route::get('/admin/user', "UserController@index");
Route::get('/admin/user/create', "UserController@create");
Route::post('/admin/user/save', "UserController@save");
Route::get('/admin/user/edit/{id}/{cp}', "UserController@edit");
Route::post('/admin/user/update/{id}/{cp}', "UserController@update");
Route::get('/admin/user/delete/{id}/{cp}/{row}', "UserController@delete");

Route::get('/user/logout', "UserController@logout");

// user role
Route::get('/admin/role', "UserRoleController@index");
Route::post('/admin/role/{cp}', "UserRoleController@save");
Route::get('/admin/role/edit/{id}/{cp}', "UserRoleController@edit");
Route::post('/admin/role/update/{id}/{cp}', "UserRoleController@update");
Route::get('/admin/role/delete/{id}/{cp}/{row}', "UserRoleController@delete");

// page route
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
Route::get('/admin/page/edit/{id}/{cp}', "PageController@edit");
Route::post('/admin/page/update/{id}/{cp}', "PageController@update");
Route::get('/admin/page/delete/{id}/{cp}/{row}', "PageController@delete");

Route::get('/admin/filemanager', "FileManagerController@index");

// shop route
Route::get('/admin/shop','ShopController@index');
Route::get('/admin/shop/create','ShopController@create');
Route::post('/admin/shop/save','ShopController@save');
Route::get('/admin/shop/edit/{id}/{cp}','ShopController@edit');
Route::post('/admin/shop/update/{id}/{cp}','ShopController@update');
Route::get('/admin/shop/delete/{id}/{cp}/{row}','ShopController@delete');

// product route
Route::get('/admin/product','ProductController@index');
Route::get('/admin/product/create','ProductController@create');
Route::post('/admin/product/save','ProductController@save');
Route::get('/admin/product/edit/{id}/{cp}','ProductController@edit');
Route::post('/admin/product/update/{id}/{cp}','ProductController@update');
Route::get('/admin/product/delete/{id}/{cp}/{row}','ProductController@delete');

Route::get('/admin/product/photo/{id}/{cp}','ProductController@photo');
Route::post('/admin/product/photo/uploads','ProductController@upload_photo');
Route::get('/admin/product/photo/remove/{id}/{cp}/{pid}','ProductController@delete_photo');