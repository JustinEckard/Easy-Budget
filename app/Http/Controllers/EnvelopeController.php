<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Envelope;
use App\Models\User;

class EnvelopeController extends Controller
{
    public function destroy(string $id)
    {
        $envelope = Envelope::findOrFail($id); // Find the transaction

        $envelope->delete(); // Delete the transaction

        $user = User::findOrFail($envelope->user_id);
        $user->updateTotal();



        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}
