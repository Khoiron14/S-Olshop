<?php

namespace App\Listeners\Items\Images;

use Storage;
use App\Events\Items\Updated;
use App\Events\Items\Deleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Delete
{
    protected $images;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->images = request()->file('images');
    }

    /**
     * Handle the event.
     *
     * @param  Updated  $event
     * @return void
     */
    public function onUpdateItem(Updated $event)
    {
        if ($this->images) {
            foreach ($event->item->images()->get() as $image) {
                Storage::delete($image->path);
            }

            $event->item->images()->delete();
        }
    }

    /**
     * Handle the event.
     *
     * @param  Deleted  $event
     * @return void
     */
    public function onDeleteItem(Deleted $event)
    {
        foreach ($event->item->images()->get() as $image) {
            Storage::delete($image->path);
        }

        $event->item->images()->delete();
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Items\Updated',
            'App\Listeners\Items\Images\Delete@onUpdateItem'
        );

        $events->listen(
            'App\Events\Items\Deleted',
            'App\Listeners\Items\Images\Delete@onDeleteItem'
        );
    }
}
