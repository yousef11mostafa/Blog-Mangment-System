<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\Jobs\SendemailJob;
use App\Mail\WelcomToRegisterdUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeToRegisterdUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterEvent $event): void
    {
        //
        SendemailJob::dispatch($event->user);
        // Mail::to($event->user->email)->send(new WelcomToRegisterdUser($event->user));
    }
}
