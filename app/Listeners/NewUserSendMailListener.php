<?php

namespace App\Listeners;

use App\Events\NewUserRegistration;
use App\Mail\NewUserSendMail;
use App\Notifications\UserRegisterationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserSendMailListener implements ShouldQueue
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
    public function handle(NewUserRegistration $event): void
    {
        $user = $event->user;
        $user->notify( new UserRegisterationNotification() );
    }
}
