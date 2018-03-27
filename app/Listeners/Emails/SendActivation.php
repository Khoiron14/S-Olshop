<?php

namespace App\Listeners\Emails;

use App\Events\Users\ActivationEmail;
use App\Mail\User\ActivationEmail as MailActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendActivation
{
    /**
     * Handle the event.
     *
     * @param  ActivationEmail  $event
     * @return void
     */
    public function handle(ActivationEmail $event)
    {
        Mail::to($event->user->email)->send(new MailActivationEmail($event->user));
    }
}
