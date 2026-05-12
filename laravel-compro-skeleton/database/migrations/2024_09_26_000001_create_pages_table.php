<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();          // home, about, contact
            $table->string('title');
            $table->string('slug')->unique();          // used for URL routing
            $table->text('content')->nullable();       // raw HTML/content
            $table->string('meta_title')->nullable();  // SEO meta title
            $table->string('meta_description')->nullable(); // SEO meta description
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};