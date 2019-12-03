<?php

namespace App\Listeners;


use App\Season;
use App\Events\SeasonEnd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetSeasonEnd
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
     * @param  SeasonEnd  $event
     * @return void
     */
    public function handle(SeasonEnd $event)
    {
        $event->Season->end_date = now();
        $event->Season->active = 0;
        $event->Season->save();
    }
}
