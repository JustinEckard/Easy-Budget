<?php

use App\Http\Controllers\EnvelopeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/login');

// Show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');

// Handle the login request
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Logout the user
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');





Route::middleware('auth')->group(function () {
    // Tracker route
    Route::get('/tracker', [TrackerController::class, 'index'])->name('tracker.index');

    // Store transaction route
    Route::post('/envelopes/{envelope}/transactions', [TransactionController::class, 'store'])->name('transactions.store');


    Route::post('/envelopes', [EnvelopeController::class, 'store'])->name('envelopes.store');

    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::delete('/envelope/{transaction}', [EnvelopeController::class, 'destroy'])->name('envelopes.destroy');
});
