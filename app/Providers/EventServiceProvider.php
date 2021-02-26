<?php

namespace App\Providers;

use App\Events\ReplyCreated;
use App\Events\TicketCreated;
use App\Events\TicketCreating;
use App\Listeners\ReplyCreatedListener;
use App\Listeners\TicketCreatedListener;
use App\Listeners\TicketCreatingListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TicketCreating::class => [
            TicketCreatingListener::class
        ],
        TicketCreated::class => [
            TicketCreatedListener::class
        ],
        ReplyCreated::class => [
            ReplyCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
