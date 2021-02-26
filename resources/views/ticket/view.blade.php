@extends('layouts.main')

@section('content')

<div class="row justify-content-center" >
    <div class="col-10 ">
        <h1>Ticket Status </h1>

        <div class="row mt-4">
            <div class="col">
                <h3 class="mb-3">Created</h3>
                <img src="{{ asset('img/success.png') }}" width="50" alt="" srcset="">
                <p>ticketd create on {{ $ticket->created_at->diffForHumans() }}</p>
            </div>
            <div class="col">
                <h3 class="mb-3">Investigating</h3>

                @if ($ticket->status === "investigating" || $ticket->status === "closed")
                    <img src="{{ asset('img/success.png') }}" width="50" alt="" srcset="">
                @else
                    <img src="{{ asset('img/waiting.png') }}" width="50" alt="" srcset="">
                @endif

                @if ($ticket->status === "investigating" || $ticket->status === "closed")
                <p>ticket investigating {{ $ticket->invested_at->diffForHumans() }}</p>
                @else
                <p>your ticket will be pick up soon</p>
                @endif

            </div>
            <div class="col">

                <h3 class="mb-3">Closed</h3>

                @if ($ticket->status === "closed")
                <img src="{{ asset('img/success.png') }}" width="50" alt="" srcset="">
                @else
                <img src="{{ asset('img/waiting.png') }}" width="50" alt="" srcset="">
                @endif

                
                @if ($ticket->status === "closed")
                <p>ticketd closed {{ $ticket->updated_at->diffForHumans() }}</p>
                @else
                <p>your ticket will be pick up soon</p>
                @endif
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            <div class="col-10 text-center">
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
            </div>
        </div>

        <hr>

        @if ($ticket->status === 'closed')
            <div class="row mt-5">
                <div class="col">
                    <div class="alert alert-success">
                        <p>ticket has been replied by {{ $ticket->reply->agent->name }}</p>
                    </div>
                
                    <p>Reply : {{ $ticket->reply->content }}</p>
                
                </div>
            </div>
        @endif
        
    </div>
</div>
@endsection