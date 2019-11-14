<?php

namespace App\Http\Controllers;

use App\Events\NewUserHasRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function index() {

        $users = User::paginate(5);
        return(view('users.index',compact('users')));
    }

    public function create()
    {
        //these two lines create a user object and then check that the user is admin to authorise them to create a new user
        $IsAdmin = \App\User::find(auth()->user()->id);
        $this->authorize('create',$IsAdmin);
        //end of auth section

        $users = User::all();
        return view('users.create' ,compact('users'));
    }

    protected function store()
    {

        $data = request()->all();
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'admin' => $data['admin'],
        ]);
        event(new NewUserHasRegistered($user->id));
        $users = User::all();
        return (view('users.index',compact('users')));
    }

    public function destroy(User $User)
    {
        $IsAdmin = \App\User::find(auth()->user()->id);
        $this->authorize('delete',$IsAdmin);

        $User->delete();
        $users = User::all();
        return(view('users.index',compact('users')));
    }

}
