<?php

namespace App\Listeners;

use App\Events\ReplyCreated;
use App\Mail\TickerCloseMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ReplyCreatedListener
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
     * @param  vent=ReplyCreated  $event
     * @return void
     */
    public function handle(ReplyCreated $event)
    {
        $ticket = $event->reply->ticket;
        $reply = $event->reply;

        Mail::to($ticket->email)->send(new TickerCloseMail($reply));
    }
}
