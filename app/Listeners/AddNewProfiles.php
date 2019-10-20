<?php

namespace App\Listeners;

use App\Events\NewUserHasRegistered;
use App\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNewProfiles
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUserHasRegistered  $event
     * @return void
     */
    public function handle(NewUserHasRegistered $event)
    {
        $user_id = $event->user_id;
        $outdoor_profile = new Profile([
        'user_id' => $user_id,
        'location' => 'outdoor'
    ]);
        $indoor_profile = new Profile([
            'user_id' => $user_id,
            'location' => 'indoor'
        ]);
        $outdoor_profile->save();
        $indoor_profile->save();
        return redirect('home');
    }

}
