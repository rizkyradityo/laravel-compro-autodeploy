<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->decimal('amount', 15, 2)->default(0);
            $table->text('message')->nullable();
            $table->string('order_id')->unique();
            $table->string('snap_token')->default('');
            $table->string('payment_status')->default('pending');
            $table->string('proof_image')->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
