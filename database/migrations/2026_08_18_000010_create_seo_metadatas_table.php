<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadatas', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('canonical_url')->nullable();
            $table->string('og_image')->nullable();
            $table->json('schema_settings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_metadatas');
    }
};
