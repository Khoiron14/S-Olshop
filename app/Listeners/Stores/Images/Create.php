<?php

namespace App\Listeners\Stores\Images;

use App\Events\Stores\Created;
use App\Events\Stores\Updated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Create
{
    protected $image;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->image = request()->file('image');
    }

    /**
     * Handle the event.
     *
     * @param  Created  $event
     * @return void
     */
    public function onCreateStore(Created $event)
    {
        $event->store->image()->create([
            'path' => $this->image->store('avatars/stores')
        ]);
    }

    /**
     * Handle the event.
     *
     * @param  Updated  $event
     * @return void
     */
    public function onUpdateStore(Updated $event)
    {
        if ($this->image) {
            $event->store->image()->update([
                'path' => $this->image->store('avatars/stores')
            ]);
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Stores\Created',
            'App\Listeners\Stores\Images\Create@onCreateStore'
        );

        $events->listen(
            'App\Events\Stores\Updated',
            'App\Listeners\Stores\Images\Create@onUpdateStore'
        );
    }
}