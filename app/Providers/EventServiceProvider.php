<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Items\Deleted' => [
            'App\Listeners\Items\Categories\Detach'
        ],

        'App\Events\Stores\Created' => [
            'App\Listeners\Stores\Images\Create',
            'App\Listeners\Roles\Assign'
        ],
    ];

    protected $subscribe = [
        'App\Listeners\Items\Images\Delete',
        'App\Listeners\Items\Images\Create',
        'App\Listeners\Items\Categories\Sync',
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
