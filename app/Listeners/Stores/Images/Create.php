<?php

namespace App\Listeners\Stores\Images;

use App\Events\Stores\Created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Create
{
    protected $image;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->image = request()->file('image');
    }

    /**
     * Handle the event.
     *
     * @param  Created  $event
     * @return void
     */
    public function handle(Created $event)
    {
        $event->store->image()->create([
            'path' => $this->image->store('avatars/stores')
        ]);
    }
}
