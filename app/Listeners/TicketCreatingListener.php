<?php

namespace App\Listeners;

use App\Events\TicketCreating;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class TicketCreatingListener
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
     * @param  vent=TicketCreating  $event
     * @return void
     */
    public function handle(TicketCreating $event)
    {
        $event->ticket->id = (string) Str::uuid();
        $event->ticket->status = Ticket::$STATUS[0];
    }
}
