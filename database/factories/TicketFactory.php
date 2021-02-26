<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        return [
            "id" => $faker->uuid,
            "customer_name" => $faker->name,
            "description" => $faker->paragraph(2),
            "email" => $faker->unique()->safeEmail,
            "phone" => "+94775068886",
            "agent_id" => Agent::factory()->create()->id,
            "status" => Ticket::$STATUS[rand(0,2)]
        ];
    }
}
