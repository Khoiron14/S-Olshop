<?php

namespace App\Listeners\Images;

use App\Events\Stores\Created as CreateStore;
use App\Events\Stores\Updated as UpdateStore;
use App\Events\Items\Created as CreateItem;
use App\Events\Items\Updated as UpdateItem;
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
        $this->images = request()->file('images') ?: request()->file('image');
    }

    /**
     * Handle the event.
     *
     * @param  CreateStore  $event
     * @return void
     */
    public function onCreateStore(CreateStore $event)
    {
        $event->store->image()->create([
            'path' => $this->images->store('avatars/stores')
        ]);
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
            $event->store->image()->update([
                'path' => $this->images->store('avatars/stores')
            ]);
        }
    }

    /**
     * Handle the event.
     *
     * @param  CreateItem  $event
     * @return void
     */
    public function onCreateItem(CreateItem $event)
    {
        foreach ($this->images as $image) {
            $event->item->images()->create(['path' => $image->store('items')]);
        }
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
            foreach ($this->images as $image) {
                $event->item->images()->create(['path' => $image->store('items')]);
            }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Stores\Created',
            'App\Listeners\Images\Create@onCreateStore'
        );

        $events->listen(
            'App\Events\Stores\Updated',
            'App\Listeners\Images\Create@onUpdateStore'
        );

        $events->listen(
            'App\Events\Items\Created',
            'App\Listeners\Images\Create@onCreateItem'
        );

        $events->listen(
            'App\Events\Items\Updated',
            'App\Listeners\Images\Create@onUpdateItem'
        );
    }
}
