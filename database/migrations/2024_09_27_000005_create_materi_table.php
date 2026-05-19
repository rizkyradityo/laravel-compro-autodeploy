<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('content_type')->default('pdf');
            $table->string('file_url')->nullable();
            $table->string('link_url')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('media_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
