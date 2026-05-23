<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('file_name');
            $blueprint->string('file_path');
            $blueprint->string('file_type')->nullable();
            $blueprint->unsignedBigInteger('size')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
