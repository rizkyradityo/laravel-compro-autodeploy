<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('capacity')->default(0);
            $table->string('registration_status')->default('open');
            $table->foreignId('media_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('published')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
