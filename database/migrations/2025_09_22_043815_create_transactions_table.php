<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Relates to the orders table
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User making the payment
        $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin verifying payment
        $table->decimal('amount_usd', 10, 2); // Payment amount in USD
        $table->decimal('amount_inr', 10, 2); // Payment amount in INR
        $table->foreignId('payment_type_id')->constrained('payment_types')->onDelete('cascade'); // Foreign key for payment type
        $table->string('trx_id'); // Unique transaction ID
        $table->text('notes')->nullable(); // Additional notes
        $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending'); // Payment status
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
