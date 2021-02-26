@extends('layouts.support')

@section('content')

<div class="row justify-content-center">
    <div class="col-10 ">
        <h1>Reply Ticket</h1>
        <hr>
        <div class="row mt-5">
            <div class="col-10">
                <p>
                    Customer name : {{ $ticket->customer_name }}
                </p>
                <p>
                    Email : {{ $ticket->email }}
                </p>
                <p>
                    Contact No : {{ $ticket->phone }}
                </p>

                <p>
                    Descriptopn : {{ $ticket->description }}
                </p>
                <p>
                    Created : {{ $ticket->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <hr>

        @if ($ticket->status === 'investigating')
            <div class="">
                <hd-ticket-reply ticket-id={{ $ticket->id }}></hd-ticket-reply>
            </div>            
        @else
            <div class="">
                <div class="alert alert-success">
                    <p>ticket has been replied by {{ $ticket->reply->agent->name }}</p>
                </div>
                
                <p>Reply : {{ $ticket->reply->content }}</p>

            </div>
        @endif
        
    </div>
</div>
@endsection