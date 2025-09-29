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
        Schema::create('pages', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->longText('content')->nullable();
    $table->string('meta_title')->nullable();
    $table->text('meta_desc')->nullable();
    $table->text('meta_keywords')->nullable();
    $table->foreignId('added_by')->constrained('users')->onDelete('cascade');
    $table->unsignedBigInteger('views')->default(0);
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->boolean('allow_seo')->default(false);
    $table->boolean('is_public')->default(true);
    $table->timestamp('published_at')->nullable();
    $table->string('template')->nullable();
    $table->string('featured_image')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
