<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_pages', function (Blueprint $table) {
            $table->id();
            $table->string('area_name');
            $table->string('slug')->unique();
            $table->string('h1_title');
            $table->string('tagline')->nullable();
            $table->text('excerpt');
            $table->longText('content');
            $table->json('local_highlights')->nullable();
            $table->json('services_offered')->nullable();
            $table->json('faqs')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_pages');
    }
};
