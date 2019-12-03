<?php

namespace App\Listeners;

use App\Events\SeasonStart;
use App\Season;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redirect;

class SetSeasonStart
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param SeasonStart $event
     * @return void
     */
    public function handle(SeasonStart $event)
    {
        if (Season::all()->where('location', $event->Season->location)->where('active', 1)->first()) {
            Redirect::back()->with('message', 'There is already an active ' . $event->Season->location . ' season.');
        } else {
        $event->Season->start_date = now();
        $event->Season->active = 1;
        $event->Season->save();}
    }


}




