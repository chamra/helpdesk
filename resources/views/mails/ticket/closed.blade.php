@component('mail::message')
# Ticket closed

## Your [ticket]({{ config('app.url')."/ticket/".$reply->ticket->id }}) has been closed

{{ $reply->content }}


Thanks<br>,
{{ config('app.name') }}
@endcomponent