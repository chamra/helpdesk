<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->search;
        $status = $request->status ? $request->status : Ticket::$STATUS[0];

        $tickets =  Ticket::where('customer_name', 'LIKE', "%$keyword%")
        ->orderBy('created_at','desc')
        ->paginate(10);

        return view('ticket.index', compact('tickets'));
    }


    public function replyTicket(Ticket $ticket)
    {
        if($ticket->status === Ticket::$STATUS[0]) {
            $ticket->update(['status' => Ticket::$STATUS[1], 'invested_at' => Carbon::now()]);
        }
        
        return view('ticket.reply',compact('ticket'));
    }

    public function create(TicketRequest $request)
    {
        $data = $request->validated();

        $ticket  = Ticket::create($data);

        return response()->json(['message' => 'success', 'ticket_id'  => $ticket->id], 200);
        
    }

    public function viewTicket(Ticket $ticket)
    {

        return view('ticket.view', compact('ticket'));
        
    }

    public function ticketSearch(Request $request)
    {
        if (Ticket::where('id', '=', $request->id)->exists()) {
            return redirect(route('ticket.view', [$request->id]));
        }

        return view("ticket.not-found");
    }
}
