<?php

namespace App\Listeners\Items\Categories;

use App\Events\Items\Created;
use App\Events\Items\Updated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sync
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
     * @param  Created  $event
     * @return void
     */
    public function onCreateItem(Created $event)
    {
        $event->item->categories()->sync(request('categoriesId'));
    }

    /**
     * Handle the event.
     *
     * @param  Updated  $event
     * @return void
     */
    public function onUpdateItem(Updated $event)
    {
        $event->item->categories()->sync(request('categoriesId'));
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Items\Created',
            'App\Listeners\Items\Categories\Sync@onCreateItem'
        );

        $events->listen(
            'App\Events\Items\Updated',
            'App\Listeners\Items\Categories\Sync@onUpdateItem'
        );
    }
}
