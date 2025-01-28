<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="password_confirmation">Confirm Password:</label><br>
    <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

    <button type="submit">Create User</button>
</form>
