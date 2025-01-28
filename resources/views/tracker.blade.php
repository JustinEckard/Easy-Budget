<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker</title>
    @vite('resources/css/app.css')
</head>

<body class="container">
    <div class="heading bg-blue-300 px-10 py-6 container flex justify-between mb-4 rounded-b-lg">
        <h1 class="text-2xl">Logged in as {{ auth()->user()->username; }}</h1>
        <p>Total Balance: {{ auth()->user()->total }}</p>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="">
        Add and Envelope
        <form action="{{ route('envelopes.store') }}" method="POST">
            @csrf
            <label for="name">Envelope Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required><br><br>

            <label for="goal_amount">Goal Amount:</label><br>
            <input type="number" step="0.01" name="goal_amount" id="goal_amount" value="{{ old('goal_amount') }}" required><br><br>

            <button type="submit">Add Envelope</button>
        </form>
    </div>
    <div class=" ">
        @foreach (auth()->user()->envelopes as $envelope)
            <div class="envelope rounded-xl mb-4 bg-orange-200 overflow-hidden">
                <div class="bg-red-100 flex justify-between px-10 py-6">
                    <h3>{{ $envelope->name }}</h3>
                    <p>Current Value: {{ $envelope->amount }} / {{ $envelope->goal_amount }}</p>
                    <form action="{{ route('envelopes.destroy', $envelope->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this envelope and all its transactions?');">
                            Delete Envelope
                        </button>
                    </form>
                </div>
                <div class="px-10 py-6">
                    <div class="add-transaction">
                        <form action="{{ route('transactions.store', $envelope->id) }}" method="POST" class="flex justify-between">
                            @csrf
                            <div class="">
                                <label for="title-{{ $envelope->id }}">Transaction Title:</label><br>
                                <input type="text" name="title" id="title-{{ $envelope->id }}" required><br><br>
                            </div>
                            <div class="">
                                <label for="transaction_amount-{{ $envelope->id }}">Amount:</label><br>
                                <input type="number" step="0.01" name="transaction_amount" id="transaction_amount-{{ $envelope->id }}" required><br><br>
                            </div>
                            <div class="">
                                <label for="type-{{ $envelope->id }}">Type:</label><br>
                                <select name="type" id="type-{{ $envelope->id }}" required>
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                    <option value="transfer">Transfer</option>
                                </select><br><br>
                            </div>
                            <div class="">
                                <label for="notes-{{ $envelope->id }}">Notes:</label><br>
                                <textarea name="notes" id="notes-{{ $envelope->id }}"></textarea><br><br>
                            </div>
                            <button type="submit">Add Transaction</button>
                        </form>
                    </div>
                    <div class="transactions">
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
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</body>

</html>
