<?php

namespace App\Listeners\Images;

use Storage;
use App\Events\Users\Updated as UpdateUser;
use App\Events\Stores\Updated as UpdateStore;
use App\Events\Stores\Deleted as DeleteStore;
use App\Events\Items\Updated as UpdateItem;
use App\Events\Items\Deleted as DeleteItem;
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
        $this->images = request()->file('images') ?: request()->file('image');
    }

    /**
     * Handle the event.
     *
     * @param  UpdateUser  $event
     * @return void
     */
    public function onUpdateUser(UpdateUser $event)
    {
        if ($this->images) {
            Storage::delete($event->user->image()->first()->path);
        }
    }

    /**
     * Handle the event.
     *
     * @param  UpdateStore  $event
     * @return void
     */
    public function onUpdateStore(UpdateStore $event)
    {
        if ($this->images) {
            Storage::delete($event->store->image()->first()->path);
        }
    }

    /**
     * Handle the event.
     *
     * @param  DeleteStore  $event
     * @return void
     */
    public function onDeleteStore(DeleteStore $event)
    {
        Storage::delete($event->store->image()->first()->path);
        $event->store->image()->delete();
    }

    /**
     * Handle the event.
     *
     * @param  UpdateItem  $event
     * @return void
     */
    public function onUpdateItem(UpdateItem $event)
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
     * @param  DeleteItem  $event
     * @return void
     */
    public function onDeleteItem(DeleteItem $event)
    {
        foreach ($event->item->images()->get() as $image) {
            Storage::delete($image->path);
        }

        $event->item->images()->delete();
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Users\Updated',
            'App\Listeners\Images\Delete@onUpdateUser'
        );

        $events->listen(
            'App\Events\Stores\Updated',
            'App\Listeners\Images\Delete@onUpdateStore'
        );

        $events->listen(
            'App\Events\Stores\Deleted',
            'App\Listeners\Images\Delete@onDeleteStore'
        );

        $events->listen(
            'App\Events\Items\Updated',
            'App\Listeners\Images\Delete@onUpdateItem'
        );

        $events->listen(
            'App\Events\Items\Deleted',
            'App\Listeners\Images\Delete@onDeleteItem'
        );
    }
}
