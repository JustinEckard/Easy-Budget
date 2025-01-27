<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker</title>
</head>

<body>
    <h1>User: {{ $user->username }}</h1>
    <p>Total Balance: {{ $user->total }}</p>

    <h2>Envelopes</h2>
    @foreach ($user->envelopes as $envelope)
        <div>
            <h3>{{ $envelope->name }}</h3>
            <p>Current Value: {{ $envelope->amount }} / {{ $envelope->goal_amount }}</p>
            <form action="{{ route('envelopes.destroy', $envelope->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="return confirm('Are you sure you want to delete this envelope and all its transactions?');">
                    Delete Envelope
                </button>
            </form>
            <h4>Transactions</h4>
            <ul>
                @foreach ($envelope->transactions as $transaction)
                    <li>
                        <strong>{{ $transaction->title }}</strong>: {{ $transaction->transaction_amount }}
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this transaction?');">
                                Delete
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <h4>Add a Transaction</h4>
            <!-- Transaction Form for this Envelope -->
            <form action="{{ route('transactions.store', $envelope->id) }}" method="POST">
                @csrf
                <label for="title-{{ $envelope->id }}">Transaction Title:</label><br>
                <input type="text" name="title" id="title-{{ $envelope->id }}" required><br><br>

                <label for="transaction_amount-{{ $envelope->id }}">Amount:</label><br>
                <input type="number" step="0.01" name="transaction_amount"
                    id="transaction_amount-{{ $envelope->id }}" required><br><br>

                <label for="type-{{ $envelope->id }}">Type:</label><br>
                <select name="type" id="type-{{ $envelope->id }}" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                    <option value="transfer">Transfer</option>
                </select><br><br>

                <label for="notes-{{ $envelope->id }}">Notes:</label><br>
                <textarea name="notes" id="notes-{{ $envelope->id }}"></textarea><br><br>

                <button type="submit">Add Transaction</button>
            </form>
        </div>
    @endforeach
</body>

</html>
