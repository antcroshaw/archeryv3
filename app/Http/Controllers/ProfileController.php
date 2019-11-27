<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $profiles = Profile::paginate(5);
       return(view('profiles.index',compact('profiles')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @return Response
     */
    public function store()
    {

        $profile = Profile::create($this->validateRequest());
        $this->storeImage($profile);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $Profile
     * @return Response
     * @throws AuthorizationException
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
     * @param Profile $Profile
     * @return Response
     */
    public function edit(Profile $Profile)
    {
       // $this->authorize('update',$Profile);
        $User = \App\User::find(auth()->user()->id);
        return (view('profiles.edit',compact('Profile','User')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Profile $Profile
     * @return Response
     */
    public function update(Profile $Profile)
    {

       $Profile->update($this->validateRequest());

        $this->storeImage($Profile);

        $profiles = Profile::paginate(5);
        return(view('profiles.index',compact('profiles')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $Profile
     * @return Response
     * @throws \Exception
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

            $image = Image::make(public_path('storage/' . $Profile->image))->fit(300, 200, null, 'top-left');
            $image->save();
        }


    }
    private function validateRequest()
    {
        return request()->validate([
            'user_id'=> 'sometimes', // this has to be sometimes because we use the same validation for update and store, and we don't change user_id on update
            'location' => 'required|min:3',
            'bow' => 'required|min:3',
           'image' => 'sometimes|file|image|max:5000',
        ]);
    }

}
