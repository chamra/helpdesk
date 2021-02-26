@component('mail::message')
# Ticket create

one of our support agent will attend to the ticks ASAP

@component('mail::button', ['url' => config('app.url')."/ticket/$ticket->id"])
Check Progerss
@endcomponent



Thanks<br>,
{{ config('app.name') }}
@endcomponent