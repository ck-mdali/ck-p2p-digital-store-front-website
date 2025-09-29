<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancersTable extends Migration
{
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('tagline')->nullable();
            $table->text('about')->nullable();

            $table->string('github_link')->nullable();
            $table->string('website_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->text('portfolios')->nullable(); // Store comma-separated links

            $table->decimal('pricing_usd', 8, 2)->nullable();
            $table->decimal('pricing_inr', 8, 2)->nullable();
            $table->string('pricing_tagline')->nullable();

            $table->text('skills')->nullable();
            $table->text('address')->nullable();

            $table->string('aadhaar_card')->nullable(); // Could store file path
            $table->string('pan_card')->nullable();
            $table->string('profile_picture')->nullable();

            $table->boolean('verified_badge')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->unsignedTinyInteger('rating')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('freelancers');
    }
}
