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

//Auth::routes();
Auth::routes(['verify' => true, 'register' => true]);

Route::get('/home', 'HomeController@index')->name('home');
// records routes

Route::resource('/Record','RecordController');
Route::resource('/User','UserController');
//Route::get('/Profile/{profile}', 'ProfileController@show');
//Route::get('/Profile/', 'ProfileController@index');
Route::resource('/Profile','ProfileController');
//Route::get('/Record/index','RecordController@index');
//Route::get('/home/user','UserController@index')->name('users');
//Route::get('/home/user/create','UserController@create')->name('user_create');
//Route::post('/home/user/{data}','UserController@store')->name('user_store');
//Route::post('/home/user/{User}','UserController@destroy')->name('user_destroy');
