<?php

namespace App\Providers;

use App\Events\NewUserHasRegistered;
use App\Listeners\AddNewProfiles;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewUserHasRegistered' => [
            'App\Listeners\AddNewProfiles',
        ],
        'App\Events\SeasonStart' => [
            'App\Listeners\SetSeasonStart',
        ],
        'App\Events\SeasonEnd' => [
            'App\Listeners\SetSeasonEnd',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
