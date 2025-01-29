<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="container px-10 flex align-middle justify-center h-full">
    <div class="mt-12 px-10 py-6 bg-gray-800 min-w-[400px]">
        <h1 class="mb-4 text-center">Easy Budget</h1>
        <form class="mb-4" action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="text" id="name" name="name" required><br><br>

            <label for="username">Username:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label><br>
            <input class=" w-full rounded-lg text-gray-900" type="password" id="password" name="password" required><br><br>

            <label for="password_confirmation">Confirm Password:</label><br>
            <input class=" w-full rounded-lg text-gray-900 " type="password" id="password_confirmation" name="password_confirmation" required><br><br>

            <button class="bg-green-600 px-10 py-2 rounded-lg w-full" type="submit">Create User</button>
        </form>
        <p>Already have an account? <a class=" text-green-600 underline font-semibold" href="/">Login here</a>.</p>
    </div>
</body>
</html>
