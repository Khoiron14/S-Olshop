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

        'App\Events\Stores\Deleted' => [
            'App\Listeners\Roles\Remove',
            'App\Listeners\Items\Delete'
        ],

        'App\Events\Items\Purchased' => [
            'App\Listeners\Carts\Delete'
        ],
    ];

    protected $subscribe = [
        'App\Listeners\Roles\Assign',
        'App\Listeners\Images\Delete',
        'App\Listeners\Images\Create',
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
