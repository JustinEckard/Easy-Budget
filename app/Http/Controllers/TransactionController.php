<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Envelope;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $envelopeId)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'transaction_amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense,transfer',
            'notes' => 'nullable|string',
        ]);

        // Create the transaction
        $transaction_value = $request->transaction_amount;

        if($request->type == 'expense' ){
            $transaction_value = $request->transaction_amount*-1;
        }

        Transaction::create([
            'user_id' => auth()->id(), // Authenticated users
            'envelope_id' => $envelopeId,
            'title' => $request->title,
            'type' => $request->type,
            'transaction_amount' => $transaction_value,
            'notes' => $request->notes,
        ]);

        // Update the envelope's total
        $envelope = Envelope::findOrFail($envelopeId);
        $envelope->updateTotal();

        $user = User::findOrFail(auth()->id());
        $user->updateTotal();

        return back()->with('success', 'Transaction added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id); // Find the transaction

        $transaction->delete(); // Delete the transaction

        // Update the envelope's total
        $envelope = Envelope::findOrFail($transaction->envelope_id);
        $envelope->updateTotal();

        $user = User::findOrFail($transaction->user_id);
        $user->updateTotal();



        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}

// Schema::create('transactions', function(Blueprint $table){
//     $table->id();
//     $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Reference to users table
//     $table->foreignId('envelope_id')->constrained('envelopes')->cascadeOnDelete(); // Reference to envelopes table
//     $table->double('transaction_amount');
//     $table->string('title', 100);
//     $table->text('notes')->nullable();
//     $table->string('type', 20)->comment('income, expense, transfer');
//     $table->timestamps(); // Adds created_at and updated_at
//     $table->boolean('recurring_transaction')->default(false);
//     $table->string('frequency', 20)->nullable()->comment('daily, weekly, monthly, yearly');
//     $table->text('description')->nullable();
//     $table->timestamp('end_date')->nullable();
// });
