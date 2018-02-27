<?php

namespace App\Listeners\Items\Images;

use Storage;
use App\Events\Items\Updated;
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
        $this->images = request()->file('images');
    }

    /**
     * Handle the event.
     *
     * @param  Updated  $event
     * @return void
     */
    public function handle(Updated $event)
    {
        if ($this->images) {
            foreach ($event->item->images()->get() as $image) {
                Storage::delete($image->path);
            }

            $event->item->images()->delete();
        }
    }
}
