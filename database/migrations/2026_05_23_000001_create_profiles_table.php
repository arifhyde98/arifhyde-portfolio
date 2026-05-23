<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name');
            $blueprint->string('title')->nullable();
            $blueprint->string('short_bio')->nullable();
            $blueprint->text('about_description')->nullable();
            $blueprint->string('profile_photo')->nullable();
            $blueprint->string('resume_url')->nullable();
            $blueprint->string('email')->nullable();
            $blueprint->string('whatsapp')->nullable();
            $blueprint->string('github')->nullable();
            $blueprint->string('linkedin')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
