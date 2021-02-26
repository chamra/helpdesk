<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Mail\TicketCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TicketCreatedListener
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
     * @param  vent=TicketCreatd  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        $ticket = $event->ticket;
        
        Mail::to($ticket->email)->send(new TicketCreatedMail($ticket));
    }
}
