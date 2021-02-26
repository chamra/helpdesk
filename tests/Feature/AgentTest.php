<?php

namespace Tests\Feature;

use App\Models\Agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AgentTest extends TestCase
{
    use RefreshDatabase;
    
  
    public function test_anyone_can_access_agent_login_page()
    {
        $response = $this->get(route('agent.login'));

        $response->assertStatus(200);
    }

    public function test_agent_must_have_email_and_password()
    {
        $response = $this->post(route('agent.login'));

        $response->assertSessionHasErrors([
            "email" => "The email field is required.",
            "password" => "The password field is required."
        ]);
    }

    public function test_agent_must_have_valid_email_to_login()
    {
        $response = $this->post(route('agent.login'), ['email' => "not vaild email", "password" => "123123"]);

        $response->assertSessionHasErrors([
            "email" => "The email must be a valid email address."
        ]);
    }

    public function test_agent_can_login()
    {
        $password = "123132";
        $agent = Agent::factory()->create(["password" => bcrypt($password)]);

        $response = $this->post(route('agent.login'), ['email' => $agent->email, "password" => $password]);

        $this->assertTrue(Auth::check());
    }

    public function test_only_an_agent_can_view_the_dashboard()
    {

        $response = $this->get(route('agent.dashboard'));
        $response->assertStatus(302);
    }


    public function test_agent_can_see_new_tickets_in_the_the_dashboard()
    {
        $password = "123132";
        $agent = Agent::factory()->create(["password" => bcrypt($password)]);
        Auth::login($agent);

        $response = $this->get(route('agent.dashboard'));

        $response->assertSee("New Tickets");
    }
    
}
