<?php

use App\Http\Controllers\EnvelopeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\TransactionController;

// Tracker route
Route::get('/tracker', [TrackerController::class, 'index']);

// Store transaction route
Route::post('/envelopes/{envelope}/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
Route::delete('/envelope/{transaction}', [EnvelopeController::class, 'destroy'])->name('envelopes.destroy');

