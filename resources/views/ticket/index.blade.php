@extends('layouts.support')

@section('content')

<div class="row mt-5 justify-content-center">
    <div class="col-10">
        <h1>Tickets</h1>

        <div>
            <form action="{{ route('ticket.index') }}">
                <div class="row bg-secondary p-2">


                    <div class="col-2">
                        Customer Name
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" name="search" value="{{ request('search') }}"
                            placeholder="enter customer name">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-sm btn-primary">seach</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <td>
                            Custormer Name
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Phone
                        </td>
                        <td>
                            Status
                        </td>
                        <td>
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>
                            {{ $ticket->customer_name }}
                        </td>
                        <td>
                            {{ $ticket->email }}
                        </td>
                        <td>
                            {{ $ticket->phone }}
                        </td>
                        <td>
                            @switch($ticket->status)
                            @case('closed')
                            <label class="badge  badge-success">closed</label>
                            @break
                            @case('investigating')
                            <label class="badge  badge-primary">investigating</label>
                            @break
                            @default
                            <label class="badge  badge-warning">opened</label>
                            @endswitch
                        </td>
                        <td>
                            <div class="btn-group">

                                @if ($ticket->status === 'opened' || $ticket->status === 'investigating')
                                <a href="{{ route('ticket.reply', [$ticket->id]) }}" class="btn btn-warning btn-sm">
                                    reply
                                </a>
                                @else
                                <a href="{{ route('ticket.reply', [$ticket->id]) }}" class="btn btn-success btn-sm">
                                    view
                                </a>
                                @endif
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="pagination-wrapper"> {!! $tickets->appends(['search' =>
                Request::get('search')])->render("pagination::bootstrap-4") !!}
            </div>


        </div>

    </div>
</div>
@endsection