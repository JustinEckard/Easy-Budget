<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Envelope;
use Illuminate\Database\Seeder;

class EnvelopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Envelope::create([
                'user_id' => 1, // Assuming the dummy user has ID 1
                'name' => "Envelope $i",
                'amount' => rand(50, 500),
                'goal_amount' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
