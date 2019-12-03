<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = \App\User::find(auth()->user()->id);
        $profiles = $user->profiles;
        return view('home',compact('profiles'));
    }


}
