<?php

namespace App\Listeners\Items;

use App\Events\Stores\Deleted as DeleteStore;
use App\Events\Items\Deleted as DeleteItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Delete
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
     * @param  Deleted  $event
     * @return void
     */
    public function handle(DeleteStore $event)
    {
        foreach ($event->store->items()->get() as $item) {
            event(new DeleteItem($item));
        }

        $event->store->items()->delete();
    }
}
