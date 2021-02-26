<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'content' => $this->faker->paragraph(2),
            'agent_id' => Agent::factory()->create()->id,
            'ticket_id' => Ticket::factory()->create(['status' => Ticket::$STATUS[1]])->id,
        ];
    }
}
