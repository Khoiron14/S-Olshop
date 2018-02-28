<?php

namespace App\Listeners\Items;

use App\Events\Stores\Deleted as DeleteStore;
use App\Events\Items\Deleted as DeleteItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Delete
{
    protected $items;

    /**
     * Handle the event.
     *
     * @param  Deleted  $event
     * @return void
     */
    public function handle(DeleteStore $event)
    {
        $this->items = $event->store->items();

        if ($this->items) {
            foreach ($this->items->get() as $item) {
                event(new DeleteItem($item));
            }

            $this->items->delete();
        }
    }
}
