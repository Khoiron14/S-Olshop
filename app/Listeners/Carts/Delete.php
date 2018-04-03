<?php

namespace App\Listeners\Carts;

use App\Events\Items\Purchased;
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
     * @param  Purchased  $event
     * @return void
     */
    public function handle(Purchased $event)
    {
        auth()->user()->carts()->whereItemId($event->purchase->item->id)->delete();
    }
}
