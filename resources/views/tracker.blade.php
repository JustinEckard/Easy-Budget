<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker</title>
    @vite('resources/css/app.css')
</head>

<body class="container flex gap-6 flex-col">
    <div class="px-10">
        <div class="px-10 py-6 bg-gray-800 flex justify-between items-center rounded-b-lg">
            <h1 class="">Logged in as {{ auth()->user()->username }}</h1>
            <p class="text-lg font-semibold">Total Balance: {{ auth()->user()->total }}</p>
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="flex px-10  justify-between items-center">
        <form class=" w-full bg-gray-500 px-10 py-6 rounded-lg" action="{{ route('envelopes.store') }}" method="POST">
            <h2 class=" mb-4">Add an Envelope</h2>
            @csrf
            <div class="flex justify-between items-center gap-4">
                <div class="">
                    <label for="name">Envelope Name:</label><br>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                </div>
                <div class="">
                    <label for="goal_amount">Goal Amount:</label><br>
                    <input type="number" step="0.01" name="goal_amount" id="goal_amount"
                        value="{{ old('goal_amount') }}" required>
                </div>
                <div class="pt-6">
                    <button type="submit">Add Envelope</button>
                </div>
            </div>
        </form>
    </div>
    <div class="px-10">
        @foreach (auth()->user()->envelopes as $envelope)
            <div class="w-full bg-gray-500 px-10 py-6 rounded-lg mb-8">
                <div class="flex justify-between bg-gray-600 px-8 py-4 rounded-xl items-center mb-4">
                    <h2>{{ $envelope->name }}</h2>
                    <p class="text-lg font-semibold">Current Value: {{ $envelope->amount }} /
                        {{ $envelope->goal_amount }}</p>
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
                <div class="">
                    <div class="">
                        <h3 class="mb-2">Add a Transaction</h3>
                        <form action="{{ route('transactions.store', $envelope->id) }}" method="POST"
                            class="flex justify-between bg-gray-600 px-8 py-4 rounded-xl items-center mb-4">
                            @csrf
                            <div class="">
                                <label for="title-{{ $envelope->id }}">Transaction Title:</label><br>
                                <input type="text" name="title" id="title-{{ $envelope->id }}" required><br><br>
                            </div>
                            <div class="">
                                <label for="transaction_amount-{{ $envelope->id }}">Amount:</label><br>
                                <input type="number" step="0.01" name="transaction_amount"
                                    id="transaction_amount-{{ $envelope->id }}" required><br><br>
                            </div>
                            <div class="">
                                <label for="type-{{ $envelope->id }}">Type:</label><br>
                                <select name="type" id="type-{{ $envelope->id }}" required>
                                    <option value="expense">Expense</option>
                                    <option value="income">Income</option>
                                </select><br><br>
                            </div>
                            <button type="submit">Add Transaction</button>
                        </form>
                    </div>
                    <div class="">
                        <h3 class=" pb-4">Transactions</h3>
                        <ul>
                            @foreach ($envelope->transactions as $transaction)
                                <li class=" w-full  py-2  bg-gray-800 px-5 mb-2 rounded-lg">
                                    <div class="grid grid-cols-4">
                                        <div class="">
                                            <strong>{{ $transaction->title }}</strong>
                                        </div>
                                        <div class="">
                                            R {{ $transaction->transaction_amount }}
                                        </div>
                                        <div class="">
                                            {{ $transaction->created_at }}
                                        </div>
                                        <div class="">
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class=" bg-transparent underline py-0 text-green-400 font-semibold"
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this transaction?');">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>

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
