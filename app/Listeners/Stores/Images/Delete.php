<?php

namespace App\Listeners\Stores\Images;

use Storage;
use App\Events\Stores\Updated;
use App\Events\Stores\Deleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Delete
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
     * @param  Updated  $event
     * @return void
     */
    public function onUpdateStore(Updated $event)
    {
        if ($this->image) {
            Storage::delete($event->store->image()->first()->path);
        }
    }

    /**
     * Handle the event.
     *
     * @param  Deleted  $event
     * @return void
     */
    public function onDeleteStore(Deleted $event)
    {
        if ($this->image) {
            Storage::delete($event->store->image()->first()->path);
            $event->store->image()->delete();
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Stores\Updated',
            'App\Listeners\Stores\Images\Delete@onUpdateStore'
        );

        $events->listen(
            'App\Events\Stores\Deleted',
            'App\Listeners\Stores\Images\Delete@onDeleteStore'
        );
    }
}
