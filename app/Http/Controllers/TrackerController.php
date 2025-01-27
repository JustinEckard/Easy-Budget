<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Envelope;
use App\Models\Transaction;

class TrackerController extends Controller
{
    public function index()
    {
        $user = User::with('envelopes.transactions')->find(1); // Load user, envelopes, and transactions
        return view('tracker', compact('user'));
    }

    public function store(Request $request, $envelopeId)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:100',
            'transaction_amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense,transfer',
            'notes' => 'nullable|string',
        ]);

        // Create the transaction
        Transaction::create([
            'user_id' => $request->id, // Authenticated user
            'envelope_id' => $envelopeId, // From route parameter
            'title' => $request->title,
            'transaction_amount' => $request->transaction_amount,
            'type' => $request->type,
            'notes' => $request->notes,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Transaction added successfully.');
    }
}



