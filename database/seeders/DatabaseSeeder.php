<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Events;
use App\Models\Tickets;
use Carbon\Carbon;
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
        Events::factory()->count(3)->create(['category' => '7','start' => Carbon::now()->addDay()]);

        return;

        $firstEvent = Events::first();
        Tickets::factory()->create([
            'event_id' => $firstEvent->id
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
