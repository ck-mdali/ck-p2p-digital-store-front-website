<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description_lt');

            $table->json('screenshots')->nullable();
            $table->string('youtube_url')->nullable();

            $table->decimal('price_usd', 10, 2);
            $table->decimal('price_inr', 10, 2);

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('added_by')->constrained('users')->cascadeOnDelete();

            $table->string('demo_url')->nullable();

            $table->string('tech_support')->nullable();
            $table->string('custom_mods')->nullable();
            $table->string('license')->nullable();

            $table->string('keywords')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
