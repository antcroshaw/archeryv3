<?php

namespace App\Providers;

use App\Providers\NewUserHasRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNewProfilesListener
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
     * @param  NewUserHasRegisteredEvent  $event
     * @return void
     */
    public function handle(NewUserHasRegisteredEvent $event)
    {
        //
    }
}
