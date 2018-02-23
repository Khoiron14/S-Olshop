<?php

namespace App\Listeners\Items;

use App\Events\Items\Created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Category
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
    public function handle(Created $event)
    {
        $event->item->categories()->sync(request('categoriesId'));
    }
}
