<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Envelope extends Model
{
    // Allow mass assignment
    protected $fillable = ['user_id', 'name', 'amount', 'goal_amount'];

    // Define the relationship with transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Method to calculate the total of all transactions
    public function updateTotal()
    {
        $this->amount = $this->transactions()->sum('transaction_amount');
        $this->save();
    }

    protected static function booted()
{
    static::deleting(function ($envelope) {
        $envelope->transactions()->delete(); // Delete related transactions
    });
}
}



