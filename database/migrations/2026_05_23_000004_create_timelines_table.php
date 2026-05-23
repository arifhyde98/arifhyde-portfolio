<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timelines', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('year'); // e.g. 2024, Jan 2026
            $blueprint->string('title');
            $blueprint->text('description')->nullable();
            $blueprint->integer('display_order')->default(0);
            $blueprint->boolean('is_active')->default(true);
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
