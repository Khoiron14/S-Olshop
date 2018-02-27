<?php

namespace App\Listeners\Items\Images;

use App\Events\Items\Created;
use App\Events\Items\Updated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Create
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
    public function onCreateItem(Created $event)
    {
        foreach ($this->images as $image) {
            $event->item->images()->create(['path' => $image->store('items')]);
        }
    }

    /**
     * Handle the event.
     *
     * @param  Update  $event
     * @return void
     */
    public function onUpdateItem(Updated $event)
    {
        if ($this->images) {
            foreach ($this->images as $image) {
                $event->item->images()->create(['path' => $image->store('items')]);
            }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Items\Created',
            'App\Listeners\Items\Images\Create@onCreateItem'
        );

        $events->listen(
            'App\Events\Items\Updated',
            'App\Listeners\Items\Images\Create@onUpdateItem'
        );
    }
}
