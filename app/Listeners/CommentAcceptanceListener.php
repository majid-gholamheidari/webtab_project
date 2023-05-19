<?php

namespace App\Listeners;

use App\Events\CommentAcceptance;
use App\Notifications\CommentAcceptanceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentAcceptanceListener
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
    public function handle(CommentAcceptance $event): void
    {
        $user = $event->user;
        $comment = $event->comment;
        $user->notify( new CommentAcceptanceNotification($comment) );
    }
}
