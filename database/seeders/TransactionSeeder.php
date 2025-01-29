<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Transaction::create([
                'user_id' => 1, // Assuming the dummy user has ID 1
                'envelope_id' => rand(1, 5), // Random envelope ID between 1 and 5
                'title' => "Transaction $i",
                'notes' => "This is a note for transaction $i",
                'type' => ['income', 'expense', 'transfer'][rand(0, 2)], // Random type
                'transaction_amount' => rand(0,10000),
                'recurring_transaction' => rand(0, 1),
                'frequency' => ['daily', 'weekly', 'monthly', 'yearly'][rand(0, 3)],
                'description' => "Description for transaction $i",
                'end_date' => now()->addDays(rand(1, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
