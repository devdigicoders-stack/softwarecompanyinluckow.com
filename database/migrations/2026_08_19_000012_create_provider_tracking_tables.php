<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommended_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('short_description');
            $table->longText('full_description')->nullable();
            $table->json('services')->nullable();
            $table->json('technologies')->nullable();
            $table->string('location')->default('Lucknow, Uttar Pradesh');
            $table->string('official_website')->default('https://softwarecompanyinlucknow.com/');
            $table->text('disclosure_note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('provider_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommended_provider_id')->nullable()->constrained('recommended_providers')->onDelete('cascade');
            $table->string('anchor_text');
            $table->string('target_url');
            $table->string('service_category')->default('general');
            $table->text('context_notes')->nullable();
            $table->unsignedBigInteger('click_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('click_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_link_id')->nullable()->constrained('provider_links')->onDelete('set null');
            $table->string('target_url');
            $table->string('referrer_url')->nullable();
            $table->string('cta_type')->default('inline');
            $table->string('user_ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });

        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->string('query');
            $table->unsignedInteger('results_count')->default(0);
            $table->string('user_ip')->nullable();
            $table->timestamps();
        });

        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('search_logs');
        Schema::dropIfExists('click_tracking');
        Schema::dropIfExists('provider_links');
        Schema::dropIfExists('recommended_providers');
    }
};
