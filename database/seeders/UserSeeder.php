<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'username' => 'G1bby',
            'name' => 'Justin Eckard',
            'email' => 'justinweckard@gmail.com',
            'password' => bcrypt('Justin02'), // Use bcrypt for hashing
            'total' => 1000,
            'envelope_count' => 5,
            'transaction_count' => 100,
            'last_login' => now(),
        ]);
    }
}
