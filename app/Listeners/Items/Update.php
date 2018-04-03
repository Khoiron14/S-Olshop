<?php

namespace App\Listeners\Items;

use App\Events\Items\Purchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Update
{
    /**
     * Handle the event.
     *
     * @param  Purchased  $event
     * @return void
     */
    public function handle(Purchased $event)
    {
        $event->purchase->item->update([
            'stock' => $event->purchase->item->stock - request()->quantity
        ]);
    }
}
