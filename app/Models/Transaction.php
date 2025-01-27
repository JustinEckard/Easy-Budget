<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',              // ID of the user who owns the transaction
        'envelope_id',          // ID of the associated envelope
        'title',                // Title of the transaction
        'transaction_amount',   // Amount for the transaction
        'type',                 // Type of transaction (income, expense, transfer)
        'notes',                // Additional notes for the transaction
        'end_date',             // Optional end date for recurring transactions
    ];

    public function envelope()
    {
        return $this->belongsTo(Envelope::class);
    }
}
