<?php

namespace Tests\Feature;

use App\Mail\TicketCreatedMail;
use App\Models\Agent;
use App\Models\Ticket;
use App\Mail\TicketCreateMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_create_ticket_page()
    {
        $response = $this->get('/');

        $response->assertSee("Welcome, Please fill this from to get support");
    }

    public function test_customer_create_tickets()
    {

        $data = [
            'customer_name' => "chamara abeysekara",
            'description' => "this is the description",
            'email' => "info@gmail.com",
            'phone' => "+94775068886"
        ];

        $response = $this->post(route('ticket.create'),$data);

        $this->assertDatabaseHas('tickets', [
            'email' => "info@gmail.com",
        ]);
    }

    public function test_agent_can_view_tickets()
    {
        $agent = Agent::factory()->create();
        $ticket = Ticket::factory()->create();

        Auth::login($agent);

        $response = $this->get(route('ticket.index'));

        $response->assertSee($ticket->customer_name);
    }

    public function test_ticket_created_confirmation_mail_sent_to_customer()
    {
        Mail::fake();

        Ticket::factory()->create();

        Mail::assertSent(TicketCreatedMail::class);
    }

    public function test_customer_can_view_ticket_status()
    {
        $ticket = Ticket::factory()->create();        

        $response = $this->get(route('ticket.view', [$ticket->id]));

        $response->assertSee("Ticket Status");
        $response->assertSee($ticket->customer_name);
    }
}
