<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('title');
            $blueprint->string('slug')->unique();
            $blueprint->string('short_description')->nullable();
            $blueprint->text('full_description')->nullable();
            $blueprint->string('image')->nullable();
            $blueprint->string('tech_tags')->nullable(); // Store tags as comma-separated or JSON
            $blueprint->string('github_link')->nullable();
            $blueprint->string('live_link')->nullable();
            $blueprint->boolean('is_featured')->default(false);
            $blueprint->integer('display_order')->default(0);
            $blueprint->boolean('is_active')->default(true);
            $blueprint->softDeletes();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
