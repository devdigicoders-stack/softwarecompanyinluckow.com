<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('h1_title');
            $table->string('tagline')->nullable();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('icon')->default('bi-cpu');
            $table->string('featured_image')->nullable();
            $table->json('target_audience')->nullable();
            $table->json('features')->nullable();
            $table->json('benefits')->nullable();
            $table->json('pricing_factors')->nullable();
            $table->json('faqs')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_solutions');
    }
};
