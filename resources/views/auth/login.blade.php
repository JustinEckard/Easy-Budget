<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="container px-10 flex align-middle justify-center h-full">
    <div class="login-tile mt-12 px-10 py-6 bg-gray-800 min-w-[400px]">
        <h1 class="mb-4 text-center">Easy Budget</h1>
        <form class="mb-4" action="{{ route('auth.login') }}" method="POST">
            @csrf
            <label for="email">Email:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="email" id="email" name="email" value="{{ old('email') }}" required><br><br>

            <label for="password">Password:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="password" id="password" name="password" required><br><br>

            <button class="bg-green-600 px-10 py-2 rounded-lg w-full" type="submit">Login</button>
        </form>

    <p>Don't have an account? <a class=" text-green-600 underline font-semibold" href="{{ route('users.create') }}">Register here</a>.</p>
    </div>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
</body>
</html>
