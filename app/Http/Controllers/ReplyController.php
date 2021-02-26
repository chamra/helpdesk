<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function create(ReplyRequest $replyRequest)
    {
        $data = $replyRequest->validated();
        $data['agent_id'] = auth()->user()->id;
        $ticket = Ticket::findOrFail($replyRequest->ticket_id);

        if ($ticket->status !== Ticket::$STATUS[1]) return  response()->json(['message' => 'invalid ticket status'], 421);

        Reply::create($data);

        $ticket->update(['status' => Ticket::$STATUS[2]]);

        return response()->json(['message' => 'success'], 200);
    }
}
