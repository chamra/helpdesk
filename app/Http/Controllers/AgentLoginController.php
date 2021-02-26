<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentLoginRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentLoginController extends Controller
{
    public function login()
    {
        return view('agent.login');
    }

    public function loginAgent(AgentLoginRequest $request)
    {
        $isSuccess = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($isSuccess) return response()->json('200');

        return response()->json(["message" => "email or password did not match"], 403);
    }

    public function dashboard()
    {
        $newTicket = Ticket::where('status', '=', Ticket::$STATUS[0])->count();
        $completedTicket = Ticket::where('status', '=', Ticket::$STATUS[2])->where('agent_id', '=', auth()->user()->id)->count();
        return view('agent.dashboard', compact('newTicket', 'completedTicket'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
