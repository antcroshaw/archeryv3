<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any profiles.
     *
     * @param User $User
     * @return mixed
     */
    public function viewAny(User $IsAdmin)
    {
        if($IsAdmin->admin == 1) {return true;} else {redirect('home');}
    }

    /**
     * Determine whether the user can view the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function view(User $User, Profile $profile)
    {
        if($User->id == $profile->user_id) {return true;} else { redirect('home');}
    }

    /**
     * Determine whether the user can create profiles.
     *
     * @param User $IsAdmin
     * @return mixed
     */
    public function create(User $IsAdmin)
    {


        if($IsAdmin->admin == 1) {return true;} else {redirect('home');}
    }

    /**
     * Determine whether the user can update the profile.
     *
     * @param User $User
     * @param \App\Profile $profile
     * @return mixed
     */
    public function update(User $User, Profile $profile)
    {
       // if($User->id == $profile->user_id) {return true;} else { redirect('home');}
    }

    /**
     * Determine whether the user can delete the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function delete(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can restore the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function restore(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function forceDelete(User $user, Profile $profile)
    {
        //
    }
}
