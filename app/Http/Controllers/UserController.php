<?php

namespace App\Http\Controllers;

use App\Events\NewUserHasRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function index() {

        $Users = User::paginate(5);
        return(view('users.index',compact('Users')));
    }

    public function create()
    {
        //these two lines create a user object and then check that the user is admin to authorise them to create a new user
        $IsAdmin = \App\User::find(auth()->user()->id);
        $this->authorize('create',$IsAdmin);
        //end of auth section


        return view('users.create');
    }

    protected function store()
    {

        $data = request()->all();
        $User =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'sex' => $data['sex'],
            'password' => Hash::make($data['password']),
            'admin' => $data['admin'],
        ]);
        event(new NewUserHasRegistered($User->id));

        return view('users.show', compact('User'));
    }

    public function destroy(User $User)
    {
        $IsAdmin = \App\User::find(auth()->user()->id);
        $this->authorize('delete',$IsAdmin);

        $User->delete();

        $Users = User::paginate(5);
        return view('users.index', compact('Users'));
    }

    public function edit(User $User) {

        return view('users.edit', compact('User'));
    }

    public function update(User $User) {

        $data = request()->all();
        $User->update($data);
        return(view('users.show',compact('User')));
    }

    public function show(User $User){
        return view('users.show', compact('User'));
    }

}
