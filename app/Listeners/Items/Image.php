<?php

namespace App\Listeners\Items;

use App\Events\Items\Created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Image
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
     * @param  Created  $event
     * @return void
     */
    public function handle(Created $event)
    {
        foreach ($this->images as $image) {
            $event->item->images()->create(['path' => $image->store('items')]);
        }
    }
}
