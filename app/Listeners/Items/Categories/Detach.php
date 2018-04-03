<?php

namespace App\Listeners\Items\Categories;

use App\Events\Items\Deleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Detach
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
    public function handle(Deleted $event)
    {
        $event->item->categories()->detach();
    }
}
