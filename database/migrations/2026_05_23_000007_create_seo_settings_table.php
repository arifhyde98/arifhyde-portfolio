<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('meta_title')->nullable();
            $blueprint->text('meta_description')->nullable();
            $blueprint->string('keywords')->nullable();
            $blueprint->string('og_title')->nullable();
            $blueprint->text('og_description')->nullable();
            $blueprint->string('og_image')->nullable();
            $blueprint->string('favicon')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
