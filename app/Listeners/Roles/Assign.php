<?php

namespace App\Listeners\Roles;

use App\Events\Users\Created as CreateUser;
use App\Events\Stores\Created as CreateStore;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Assign
{
    /**
     * Handle the event.
     *
     * @param  CreateStore  $event
     * @return void
     */
    public function onCreateUser(CreateUser $event)
    {
        $event->user->assignRole('user');
    }

    /**
     * Handle the event.
     *
     * @param  CreateStore  $event
     * @return void
     */
    public function onCreateStore(CreateStore $event)
    {
        $event->user->assignRole('seller');
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Users\Created',
            'App\Listeners\Roles\Assign@onCreateUser'
        );

        $events->listen(
            'App\Events\Stores\Created',
            'App\Listeners\Roles\Assign@onCreateStore'
        );
    }
}
