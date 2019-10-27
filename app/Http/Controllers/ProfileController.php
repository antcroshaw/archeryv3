<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();
       return(view('profiles.index',compact('profiles')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //need to send an object with all the user info in
        $user = User::all();
        return view('profiles.create' ,compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $data = request()->validate([
            'user_id'=> 'required',
            'location'=> 'required',
            'bow'=> 'required',
        ]);

        Profile::create($data);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $Profile)

    {
        //need to check user_id of profile against authorised user_id
        $this->authorize('view',$Profile);
        $User = \App\User::find(auth()->user()->id);
        return (view('profiles.show',compact('Profile','User')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $Profile)
    {
        $User = \App\User::find(auth()->user()->id);
        return (view('profiles.edit',compact('Profile','User')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $Profile)
    {
        $Profile->update($this->validateRequest());

        //$this->storeImage($Profile);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $Profile)
    {

        $Profile->delete();
        return redirect('/Profile');
    }

    private function storeImage($Profile)
    {
        if (request()->has('image')) {
            $Profile->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $Profile->image))->fit(300, 300, null, 'top-left');
            $image->save();
        }


    }
    private function validateRequest()
    {
        return request()->validate([

            'location' => 'required|min:3',
            'bow' => 'required|min:3',
          //  'image' => 'sometimes|file|image|max:5000',
        ]);
    }

}
