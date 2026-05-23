<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appearance_settings', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('hero_headline')->nullable();
            $blueprint->text('hero_subtitle')->nullable();
            $blueprint->string('primary_color')->default('#3B82F6');
            $blueprint->string('secondary_color')->default('#8B5CF6');
            $blueprint->string('bg_style')->default('dark');
            $blueprint->string('cta_text')->nullable();
            $blueprint->string('cta_link')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appearance_settings');
    }
};
