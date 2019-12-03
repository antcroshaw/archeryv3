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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/email', function() {
    return new \App\Mail\ContactUs();
});

Route::post('/contact', function(Request $request)  {Mail::send(new \App\Mail\ContactUs($request)); return redirect('/');});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Contact', function () {
    return view('contact');
});

Route::get('/Season/start/{Season}', 'SeasonController@startSeason')->name('Season.start');
Route::get('/Season/end/{Season}', 'SeasonController@endSeason')->name('Season.end');
Route::post('/Contact', 'HomeController@contact');
//Auth::routes();
Auth::routes(['verify' => true, 'register' => true]);

Route::get('/home', 'HomeController@index')->name('home');
// records routes

Route::resource('/Record','RecordController');
Route::resource('/Season','SeasonController');
Route::resource('/User','UserController');

Route::resource('/Profile','ProfileController');



