<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create'); // Render the user creation form
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Always hash passwords
            'total' => 0,
            'envelope_count' => 0,
            'transaction_count' => 0,
            'last_login' => now(),
        ]);

        // Redirect with a success message
        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}
