@extends('layouts.support')

@section('content')
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                New Tickets
            </div>
            <div class="card-body text-center">
                {{ $newTicket }}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                Completed Tickets
            </div>
            <div class="card-body text-center">
                {{ $completedTicket }}
            </div>
        </div>
    </div>
    <div class="col">
        
    </div>
</div>
@endsection