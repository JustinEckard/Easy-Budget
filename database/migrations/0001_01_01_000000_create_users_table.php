<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // My own fields
            $table->double('total')->default(0);
            $table->integer('envelope_count')->default(0);
            $table->integer('transaction_count')->default(0);
            $table->dateTime('last_login')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('envelopes', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->double('amount');
            $table->double('goal_amount');
            $table->timestamps();
        });

        Schema::create('transactions', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Reference to users table
            $table->foreignId('envelope_id')->constrained('envelopes')->cascadeOnDelete(); // Reference to envelopes table
            $table->double('transaction_amount');
            $table->string('title', 100);
            $table->text('notes')->nullable();
            $table->string('type', 20)->comment('income, expense, transfer');
            $table->timestamps(); // Adds created_at and updated_at
            $table->boolean('recurring_transaction')->default(false);
            $table->string('frequency', 20)->nullable()->comment('daily, weekly, monthly, yearly');
            $table->text('description')->nullable();
            $table->timestamp('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('envelopes');
    }
};
