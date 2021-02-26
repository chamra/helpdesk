<?php

namespace Tests\Feature;

use App\Mail\TickerCloseMail;
use App\Models\Agent;
use App\Models\Reply;
use App\Models\Ticket;
use Dotenv\Util\Regex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class ReplyTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_agent_can_reply_to_a_ticket()
    {
        $agent = Agent::factory()->create();
        $ticket = Ticket::factory()->create();
        $ticket->update(['status' => Ticket::$STATUS[1]]);

        $data = [
            "content" => "Lorem ipsum dolor sit amet, consectetaur adipisicing elit, sed do eiusmod tempor",
            "ticket_id" => $ticket->id
        ];

        Auth::login($agent);

        $this->post(route('reply.create'), $data);

        $this->assertDatabaseHas('replies', $data);
    }

    public function test_agent_can_only_reply_to_ticket_under_investigation()
    {
        $agent = Agent::factory()->create();
        $ticket = Ticket::factory()->create();

        $data = [
            "content" => "Lorem ipsum dolor sit amet, consectetaur adipisicing elit, sed do eiusmod tempor",
            "ticket_id" => $ticket->id
        ];

        Auth::login($agent);

        $response  = $this->post(route('reply.create'), $data);

        $response->assertSee("invalid ticket status");
    }

    public function test_agent_need_to_have_content_and_ticket_id_to_make_a_reply()
    {
        $agent = Agent::factory()->create();

        Auth::login($agent);

        $response  = $this->post(route('reply.create'));

        $response->assertSessionHasErrors([
            "content" => "The content field is required.",
            "ticket_id" =>  "The ticket id field is required."
        ]);
    }

    public function test_reply_email_sent_to_customer()
    {
        Mail::fake();

        Reply::factory()->create();

        Mail::assertSent(TickerCloseMail::class);
    }


}
