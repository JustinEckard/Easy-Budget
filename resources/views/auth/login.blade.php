<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Login Form -->
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <br>
    <p>Don't have an account? <a href="{{ route('users.create') }}">Register here</a>.</p>
</body>
</html>
