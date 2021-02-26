<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Agent::factory()->create(['email' => "admin@admin.com", "password" => bcrypt('123123')]);
        \App\Models\Ticket::factory(5)->create();
        \App\Models\Ticket::factory(5)->create(["agent_id" => null, "status" => Ticket::$STATUS[0]]);
        \App\Models\Ticket::factory(5)->create(["status" => Ticket::$STATUS[2]]);
        \App\Models\Reply::factory(5)->create();
    }
}
