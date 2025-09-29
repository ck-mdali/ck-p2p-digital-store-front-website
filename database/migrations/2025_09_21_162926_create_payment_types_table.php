<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the payment type (e.g., UPI, Bank Transfer, Crypto)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status (active or inactive)
            $table->text('description')->nullable(); // Description in HTML format
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade'); // User who added the payment type
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_types');
    }
}
